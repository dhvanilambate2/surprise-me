<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use DB;
use App\Models\User;
use App\Models\Report;
use App\Models\ReportItems;
use App\Models\Allreport;
use App\Models\Cardiometabolicreport;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Auth;
use DateTime;
use Smalot\PdfParser\Parser;

class DemoController extends Controller
{
    /* Dashboard page */
    public function index()
    {
        $textContent = null;
         $userid = Auth::id();
		/*$users = User::whereHas('roles' , function($q){
		   $q->whereName('Patient');
		})->get();
		*/
		
        $patients = Patient::select("id", "first_name", "last_name")
            ->groupBy("id", "first_name", "last_name")
            ->where('user_id',$userid)
            ->get();

		/*$patients = User::select("id", "first_name", "last_name")->groupBy("id", "first_name", "last_name")->whereHas('roles' , function($q){
		   $q->whereName('Patient');
		})->get();*/
		// dd($patients);
		
		$totalpatient = User::where('user_id',$userid)->count();
		$totalusers = User::count();

		$totalreport = Report::where('user_id',$userid)->count();
		// $totalallreport = Allreport::where('user_id',$userid)->count();
		$totalcardiometabolicreport = Cardiometabolicreport::where('user_id',$userid)->count();

		// $totalAllReportsSum = $totalreport + $totalallreport + $totalcardiometabolicreport;
        return view("demo", compact("textContent", "patients","totalpatient","totalusers")); //,"totalAllReportsSum"
    }

    /* Show page */
    public function show()
    {
        $patients = Report::select("first_name", "last_name", "name")
            ->distinct()
            ->get();

        $cardiometabolics = Cardiometabolicreport::select(
            "first_name",
            "last_name",
            "name"
        )
            ->distinct()
            ->get();
        $combinedData = $patients
            ->concat($cardiometabolics)
            ->unique(function ($item) {
                return $item->first_name . $item->last_name;
            });
        return view("reports", compact("combinedData"));
    }

    public function fetch_dates(Request $request)
    {
        $selectedName = $request->input("name");
        $selectedReportType = $request->input("report_type");
        $table =
            $selectedReportType === "bioage_report"
                ? "reports"
                : ($selectedReportType === "lab_report"
                    ? "cardiometabolicreports"
                    : null);
        if ($table) {
            $dates = DB::table($table)
                ->where("name", $selectedName)
                ->distinct()
                ->pluck("created_at", "id")
                ->map(function ($date, $id) use ($selectedReportType) {
                    return [
                        "created_at" => $date,
                        "report_type" => $selectedReportType,
                        "id" => $id,
                    ];
                });

            return response()->json([
                "created_dates" => $dates,
            ]);
        } else {
            return response()->json([
                "error" => "Invalid report_type parameter",
            ]);
        }
    }
    // fetch latest date
    public function fetch_latest_dates()
    {
        $latestDates = [];

        $allReportsTypes = ["bioage_report", "lab_report"];

        foreach ($allReportsTypes as $allReportsType) {
            $table =
                $allReportsType === "bioage_report"
                    ? "reports"
                    : ($allReportsType === "lab_report"
                        ? "cardiometabolicreports"
                        : null);

            if ($table) {
                $latestDate = DB::table($table)
                    ->select("name", "created_at")
                    ->orderBy("created_at", "desc")
                    ->groupBy("name")
                    ->first();

                $latestDates[$allReportsType] = $latestDate;
            }
        }

        return view("reports", compact("latestDates"));
    }
    protected function extractDetail($pattern, $text)
    {
        if (preg_match($pattern, $text, $matches)) {
            return trim($matches[1]);
        } else {
            return 'Not found';
        }
    }

    private function commonextractDetail($pattern, $text) {
        $matches = [];
        preg_match($pattern, $text, $matches);
        return isset($matches[1]) ? $matches[1] : "";
    }

    public function store(Request $request)
    {

        if (!$request->hasFile('pdf')) {
            return redirect('/dashboard')->with(['error' => 'PDF field is required.']);
        }

        $request->validate([
            'pdf' => 'required|file|mimes:pdf',
        ]);

        // PDF processing logic
        $dashboardEntry = new ReportItems();
        $image = $request->file('pdf');
        $Extension = $image->getClientOriginalExtension();
        $filename = $request->report_type . '_' . Carbon::now()->format('Ymd_His') . '.' . $Extension;
        $image->move(public_path('pdf_files'), $filename);
        $dashboardEntry->pdf = $filename;
        $pdfFilePath = public_path('pdf_files/'.$dashboardEntry->pdf);
        $data = $this->extractDataFromPDF($pdfFilePath);

        $patientId = null;
        $firstName = null;
        $lastName = null;

		$name = $data['Patient Name'];
		$nameParts = explode(', ', $name);

		// $nameParts[0] will contain the last name and $nameParts[1] will contain the first name
		$last_name = $nameParts[0];
		$first_name = $nameParts[1];
		$patient_name= $first_name." ".$last_name;
		date_default_timezone_set('Asia/Kolkata');
        if ($request->has("patient_type")) {
            $patientType = $request->patient_type;

            if ($patientType === "existing" && $request->has("patient_id")) {
                $patient = Patient::find($request->patient_id);
                if ($patient) {
                    $patientId = $patient->id;
                    $firstName = $patient->first_name;
                    $lastName = $patient->last_name;

                    // for bioage end
                    if ($request->report_type === "bioage_report") {
                        $allReports = new Report($request->all());
                        $patient = Patient::find($patientId);
                            //dd($patient);

                            if ($patient) {
								$patientId = $patient->id;
								$initialReport = Report::where('patient_id', $patientId)
													   ->where('followup', 'Initial')
													   ->first(); // Retrieve the initial report
								if ($initialReport) {
									$totalcount = Report::where('patient_id', $patientId)
                                                                      ->where('followup', 'like', 'followup-%')
                                                                      ->count();

									$count = $totalcount + 1;
									$followup = "followup-".$count;
									//dd($followup);
								} else {
									$followup = "Initial";
								}
								$allReports->followup = $followup;
								$allReports->save();
							} else {
								echo "Patient not found";
							}

						$allReports->user_id = Auth::id();
						$allReports->name = $firstName." ".$lastName;
						//dd($allReports->name);
						$allReports->first_name = $firstName;
						$allReports->last_name = $lastName;
				// 		$allReports->provider_name = $provider_name;
						$allReports->cac = $data['cac'];
                        $allReports->right_hand_est_grip_strength = $data['Right Hand Est Grip Strength'];
                        $allReports->fev_1 = $data['Fev 1'];
                        $allReports->chol = $data['Cholesterol, Total'];
                        $allReports->hdl = $data['HDL Cholesterol'];
                        $allReports->bmd = $request->bmds;
						$allReports->region = $request->regions;
						//dd($report->bmd);
						/**$bmd_report = $report->bmd();
						$report->expected_bmd = $bmd_report['expected_bmd'];
						$report->equivalent_age = $bmd_report['equivalent_age'];
						dd($report->expected_bmd, $report->equivalent_age);**/


						$phenotypic_age_demo = $allReports->phenotypic_age();
						$allReports->biological_age = $phenotypic_age_demo['biological_age'];
						$allReports->chances_of_dying = $phenotypic_age_demo['chances_of_dying'];


						$risk_score = $allReports->risk_score();
						$allReports->cac_riskscore = isset($risk_score['cac_riskscore']) ? $risk_score['cac_riskscore'] : null;
						$allReports->nocac_riskscore = isset($risk_score['nocac_riskscore']) ? $risk_score['nocac_riskscore'] : null;

						//dd($risk_score);

						$arterial_age = $allReports->arterial_age();
						$allReports->arterial_age = $arterial_age['arterial_age'];
						//dd($report->arterial_age)	;

						$lung_age = $allReports->lung_age();
						$allReports->lung_age = $lung_age['age'];
						//dd($report->lung_age);

						// for fetch bioage and labage
						$lab_age_report = $allReports->lab_age_report();
						$allReports->lab_age = $lab_age_report['lab_age'];


						$heart_age_report = $allReports->heart_age_report();
						$allReports->heart_age = $heart_age_report['heart_age'];

						// for fetchbio_age report
						$balance_age_report = $allReports->balance_age_report();
						$allReports->balance_age = $balance_age_report['balance_age'];
						// dd($record->balance_age);

						$grip_strength = $allReports->grip_strength();
						$allReports->equivalent_age_for_grip_strength = $grip_strength['equivalent_age_for_grip_strength'];
									// dd($record->equivalent_age_for_grip_strength);

						$musculoskeletal_age_report = $allReports->musculoskeletal_age_report();
						$allReports->musculoskeletal_age = $musculoskeletal_age_report['musculoskeletal_age'];
						//dd($report->musculoskeletal_age);

						$brain_age_report = $allReports->brain_age_report();
						$allReports->brain_age = $brain_age_report['brain_age'];
									// dd($record->brain_age);

						$vascular_age_report = $allReports->vascular_age_report();
						$allReports->vascular_age = $vascular_age_report['vascular_age'];

						$vascular_age_report_2 = $allReports->vascular_age_report_2();
						$allReports->vascular_age_2 = $vascular_age_report_2['vascular_age_2'];
						$allReports->percentile = $vascular_age_report_2['percentile'];

						$ekg_heart_age_report = $allReports->ekg_heart_age_report();
						$allReports->ekg_heart_age = $ekg_heart_age_report['ekg_heart_age'];

						$bio_age_report = $allReports->bio_age_report();
						$allReports->bio_age = $bio_age_report['bio_age'];

                        $allReports->albumin_liver = $data['Albumin'] ?? "";
                        $allReports->alp_liver = $data['ALP (Alkaline Phosphatase)'] ?? "";
                        $allReports->creatinine_kidney = $data['Creatinine'] ?? "";
                        $allReports->crp_immune = $data['CRP Immune'] ?? "";
                        $allReports->lympho_immune = $data['Lympho Immune'] ?? "";
                        $allReports->mcv_bone_marrow = $data['Mcv Bone Marrow'] ?? "";
                        $allReports->rdw_bone_marrow = $data['rdw'] ?? "";
                        $allReports->pwv = $data['pmv'] ?? "";
                        $allReports->imt = $data['imt'] ?? "";
                        $allReports->pr_interval = $data['PR Interval'] ?? "";
                        $allReports->hr_bp_average = $data['Hr bp average'] ?? "";
                        $allReports->hr_bp_average_dbp = $data['Hr bp average dbp'] ?? "";
                        $allReports->skin_age = $data['skin_age'] ?? "";
                        $allReports->left_breast_thermography = $data['Left Breast Thermography'] ?? "";
                        $allReports->right_breast_thermography = $data['Right Breast Thermography'] ?? "";
                        $allReports->tanita_metabolic_age =$data['Tanita Metabolic Age'] ?? "";
                        $allReports->bf_percent = $data['Bf Percent'] ?? "";
                        $allReports->vo_2_max = $data['Vo2max'] ?? "";
                        $allReports->trudiagnostic_truage =$data['Trudiagnostic Truage'] ?? "";
                        $allReports->sleep_ahi = $data['Sleep Ahi'] ?? "";
                        $allReports->hrv = $data['hrv'] ?? "";
                       //dd($allReports);
                    } elseif ($request->report_type === "lab_report") {
                        $allReports = new Cardiometabolicreport(
                            $request->all()
                        );

                        if ($patient) {
                            $patientId = $patient->id;
                            $initialReport = Cardiometabolicreport::where('patient_id', $patientId)
                                                                   ->where('followup', 'Initial')
                                                                   ->first(); // Retrieve the initial report
                            if($initialReport) {
                                $totalcount = Cardiometabolicreport::where('patient_id', $patientId)
                                                                      ->where('followup', 'like', 'followup-%')
                                                                      ->count();

								$count = $totalcount + 1;
								$followup = "followup-".$count;
                            } else {
                                $followup = "Initial";
                            }
                        } else {
                            echo "patient not found";
                        }

                        $allReports->followup = $followup;
						$allReports->user_id = Auth::id();
						$allReports->name = $patient->name;
						$allReports->first_name = $firstName;
						$allReports->last_name = $lastName;
				// 		$allReports->provider_name = $provider_name;
				        $allReports->hs_crp = $data['hs-CRP'] ?? "";
				        $allReports->oxldl = $data['OxLDL'] ?? "";
				        $allReports->estimated_average_glucose = $data['Estimated Average Glucose'] ?? "";
				        $allReports->hba1c = $data['HbA1c'] ?? "";
				        $allReports->homocysteine = $data['Homocysteine'] ?? "";
				        $allReports->egfr = $data['eGFR'] ?? "";
				        $allReports->testosterone = $data['Testosterone'] ?? "";
				        $allReports->testosterone_free = $data['Testosterone, Free'] ?? "";
				        $allReports->testosterone_free_pt = $data['Testosterone, % Free'] ?? "";
				        $allReports->shbg = $data['Sex Hormone Binding Globulin'] ?? "";
				        $allReports->ferritin = $data['Ferritin'] ?? "";
				        $allReports->prostatic_specific_ag	 = $data['Prostatic Specific Ag, Total'] ?? "";


                        $allReports->cholesterol_total = $data['Cholesterol, Total'] ?? "";
                        $allReports->hdl_cholesterol = $data['HDL Cholesterol'] ?? "";
                        $allReports->triglycerides = $data['Triglycerides'] ?? "";
                        $allReports->ldl_cholesterol_calculated = $data['LDL Cholesterol, Calculated'] ?? "";
                        $allReports->chol_hdl_c = $data['Chol/HDL-C'] ?? "";
                        $allReports->non_hdl_cholesterol = $data['Non-HDL Cholesterol'] ?? "";
                        $allReports->tg_hdl_c = $data['TG/HDL-C'] ?? "";
                        $allReports->ldl_p = $data['LDL-P(4)'] ?? "";
                        $allReports->small_ldl_p = $data['Small LDL-P'] ?? "";
                        $allReports->ldl_size = $data['LDL Size'] ?? "";
                        $allReports->hdl_p = $data['HDL-P'] ?? "";
                        $allReports->large_hdl_p = $data['Large HDL-P'] ?? "";
                        $allReports->hdl_size = $data['HDL Size'] ?? "";
                        $allReports->vldl_size = $data['VLDL Size'] ?? "";
                        $allReports->large_vldl_p = $data['Large VLDL-P'] ?? "";
                        $allReports->vitamin_d = $data['Vitamin D, 25-Hydroxy by LC-MS'] ?? "";
                        $allReports->omegacheck = $data['Whole Blood: EPA DPA DHA'] ?? "";
                        $allReports->arachidonic_acid_epa_ratio = $data['Arachidonic Acid/EPA Ratio'] ?? "";
                        $allReports->omega6_omega3_ratio = $data['Omega-6/Omega-3 Ratio'] ?? "";
                        $allReports->omega3_total = $data['Omega-3 total'] ?? "";
                        $allReports->epa = $data['EPA'] ?? "";
                        $allReports->dpa = $data['DPA'] ?? "";
                        $allReports->dha = $data['DHA'] ?? "";
                        $allReports->omega6_total = $data['Omega-6 total'] ?? "";
                        $allReports->arachidonic_acid = $data['Arachidonic Acid'] ?? "";
                        $allReports->linoleic_acid = $data['Linoleic Acid'] ?? "";
                        $allReports->co2 = $data['Bicarbonate'] ?? "";
                        $allReports->bun = $data['Blood-Urea-Nitrogen'] ?? "";
                        $allReports->creatinine = $data['Creatinine'] ?? "";
                        $allReports->calcium = $data['Calcium-Total'] ?? "";
                        $allReports->sodium = $data['Sodium'] ?? "";
                        $allReports->potassium = $data['Potassium'] ?? "";
                        $allReports->chloride = $data['Chloride'] ?? "";
                         $allReports->bun_creatinine_ratio = $data['BUN/Creatinine Ratio'] ?? "";
                        $allReports->protein = $data['Protein, Total'] ?? "";
                        $allReports->albumin = $data['Albumin'] ?? "";
                        $allReports->globulin = $data['Globulin'] ?? "";
                        $allReports->albumin_globulin_ratio = $data['Albumin/Globulin Ratio'] ?? "";
                        $allReports->alp = $data['ALP (Alkaline Phosphatase)'] ?? "";
                        $allReports->alt = $data['ALT (Alanine Amino Transferase)'] ?? "";
                        $allReports->ast = $data['AST (Aspartate Amino Transferase)'] ?? "";
                        $allReports->egfr_african_descent = $data['eGFR, African descent'] ?? "";
                        $allReports->bilirubin = $data['Bilirubin, Total'] ?? "";
                        $allReports->egfr_non_african_descent = $data['eGFR, Non-African descent'] ?? "";
                        $allReports->dhea_s = $data['DHEA-S'] ?? "";
                        $allReports->thyroid_stimulating_hormone = $data['Thyroid Stimulating Hormone'] ?? "";
                        $allReports->thyroxine = $data['Thyroxine (T4), Free'] ?? "";
                        $allReports->thyroid_peroxidase_ab = $data['Thyroid Peroxidase Ab'] ?? "";
                        $allReports->wbc = $data['WBC'] ?? "";
                        $allReports->rbc = $data['RBC'] ?? "";
                        $allReports->hemoglobin = $data['Hemoglobin'] ?? "";
                        $allReports->hematocrit = $data['Hematocrit'] ?? "";
                        $allReports->mcv = $data['MCV'] ?? "";
                        $allReports->mch = $data['MCH'] ?? "";
                        $allReports->mchc = $data['MCHC'] ?? "";
                        $allReports->rcdw = $data['Red Cell Distribution Width'] ?? "";
                        $allReports->platelet_count = $data['Platelet Count'] ?? "";
                        $allReports->mean_platelet_volume = $data['Mean Platelet Volume'] ?? "";
                        $allReports->neutrophil = $data['Neutrophil %'] ?? "";
                        $allReports->neutrophil_absolute = $data['Neutrophil Absolute'] ?? "";
                        $allReports->lymphocyte = $data['Lymphocyte %'] ?? "";
                        $allReports->lymphocyte_absolute = $data['Lymphocyte Absolute'] ?? "";
                        $allReports->monocyte = $data['Monocyte %'] ?? "";
                        $allReports->monocyte_absolute = $data['Monocyte Absolute'] ?? "";
                        $allReports->eosinophil = $data['Eosinophil %'] ?? "";
                        $allReports->eosinophil_absolute = $data['Eosinophil Absolute'] ?? "";
                        $allReports->basophil = $data['Basophil %'] ?? "";
                        $allReports->basophil_absolute = $data['Basophil Absolute'] ?? "";
                        $allReports->glucose = $data['Glucose'] ?? "";

						//lab reference fields
				// 		$allReports->chol_ref = $totalchol_ref ?? "";
				// 		$allReports->hdlchol_ref =  $hdlchol_ref ?? "";
				// 		$allReports->triglycerides_ref = $triglycerides_ref ?? "";
				// 		$allReports->ldlchol_ref = $ldlchol_ref ?? "";
				// 		$allReports->cholhdl_ref = $cholhdlc_ref ?? "";
				// 		$allReports->nonhdlchol_ref = $nonhdlchol_ref ?? "";
				// 		$allReports->tghdlc_ref = $tghdlc_ref ?? "";
				// 		$allReports->ldlp_ref = $ldlp_ref ?? "";
				// 		$allReports->small_ldlp_ref = $smallldlp_ref ?? "";
				// 		$allReports->ldlsize_ref = $ldlsize_ref ?? "";
				// 		$allReports->hdlp_ref = $hdlp_ref ?? "";
				// 		$allReports->largehdlp_ref = $largehdlp_ref ?? "";
				// 		$allReports->hdlsize_ref = $hdlsize_ref ?? "";
				// 		$allReports->largevldlp_ref = $largevldlp_ref ?? "";
				// 		$allReports->vldlsize_ref = $vldlsize_ref ?? "";

				// 		$allReports->co2_lr = $co2Value ?? "";
				// 		$allReports->bun_lr = $bunValue ?? "";
				// 		$allReports->creatinine_lr = $creatinineRange ?? "";
				// 		$allReports->buncreatinine__lr = $bunCreatinineRatioValue ?? "";
				// 		$allReports->protein_lr = $proteintotal_lr ?? "";
				// 		$allReports->albumin_lr = $albuminRange ?? "";
				// 		$allReports->globulin_lr = $globulinRange ?? "";
				// 		$allReports->albuminglobulin_lr = $albuminglobulinRange ?? "";
				// 		$allReports->alp_lr = $alpCombined ?? "";
				// 		$allReports->alt_lr = $altRange ?? "";
				// 		$allReports->ast_lr = $astRange ?? "";
				// 		$allReports->billirubin_lr = $bilirubinCombined ?? "";
				// 		$allReports->egfr_lr = $eGFRAfricanCombinedValue ?? "";
				// 		$allReports->non_egfr_lr = $eGFRCombinedValue ?? "";
				// 		$allReports->dheas_lr = $dheasRange ?? "";
				// 		$allReports->tsh_lr= $thyroidstimulatinghormoneRange ?? "";
				// 		$allReports->thyroxine_lr = $thyroxineRange ?? "";
    //                     $allReports->tpab_lr = $thyroidPeroxidaseAb_lr ?? "";
				// 		$allReports->wbc_lr = $wbcRange ?? "";
				// 		$allReports->rbc_lr = $rbcRange ?? "";
				// 		$allReports->hemoglobin_lr = $hemoglobinRange ?? "";
				// 		$allReports->hematocrit_lr = $hematocritRange ?? "";
				// 		$allReports->mcv_lr = $mcvRange ?? "";
				// 		$allReports->mch_lr = $mchRange ?? "";
				// 		$allReports->mchc_lr = $mchcRange ?? "";
				// 		$allReports->rcdw_lr = $rcdwRange ?? "";
				// 		$allReports->pc_lr = $pcRange ?? "";
				// 		$allReports->mpv_lr = $mpvRange ?? "";
				// 		$allReports->neutrophil_lr = $neutrophilRange ?? "";
				// 		$allReports->neutrophilabsolute_lr = $neutrophil_absoluteRange ?? "";
				// 		$allReports->lymphocyte_lr = $lymphocyteRange ?? "";
				// 		$allReports->lymphocyteabsolute_lr = $lymphocyte_absoluteRange ?? "";
				// 		$allReports->monocyte_lr= $monocyteRange ?? "";
				// 		$allReports->monocyteabsolute_lr = $monocyte_absoluteRange ?? "";
				// 		$allReports->eosinophil_lr = $eosinophilRange ?? "";
				// 		$allReports->eosinophilabsolute_lr = $eosinophil_absoluteRange ?? "";
				// 		$allReports->basophil_lr = $basophilRange ?? "";
				// 		$allReports->basophilabsolute_lr = $basophil_absoluteRange ?? "";

				// 		/**$currentDateTime = now();
				// 		$timezone = $currentDateTime->getTimezone()->getName();
				// 		$formattedDateTime = $currentDateTime->format('Y-m-d h:i:s A');
				// 		$created_at = $formattedDateTime . ' ' . $timezone;
				// 		$allReports->created_at = $created_at;
				// 		dd($allReports->created_at);**/


                    } elseif ($request->report_type === "combine_report") {
                        $allReports = new Allreport($request->all());
                        $patient = Patient::find($patientId);
                            if ($patient) {
                                $patientId = $patient->id;
                                $initialReport = Allreport::where('patient_id', $patientId)
                                                                       ->where('followup', 'Initial')
                                                                       ->first(); // Retrieve the initial report
                                if($initialReport) {
                                    $totalcount = Allreport::where('patient_id', $patientId)
                                                                          ->where('followup', 'like', 'followup-%')
                                                                          ->count();
                                    $count = $totalcount + 1;
									$followup = "followup-".$count;
                                    $allReports->followup =  $followup;
                                } else {
                                    $followup = "Initial";
                                    $allReports->followup =  $followup;
                                }
                            } else {
                                echo "patient not found";
                            }

				// 		$allReports->provider_name = $provider_name;
                        // Bioage report
						$allReports->user_id = Auth::id();
						$allReports->name = $patient->name;
						$allReports->first_name = $firstName;
						$allReports->last_name = $lastName;
				// 		$allReports->provider_name = $provider_name;
                        $allReports->cac = $data['cac'];
                        $allReports->right_hand_est_grip_strength = $data['Right Hand Est Grip Strength'];
                        $allReports->fev_1 = $data['Fev 1'];
                        $allReports->chol = $data['Cholesterol, Total'];
                        $allReports->hdl = $data['HDL Cholesterol'];
                        $allReports->cac_riskscore = $data['CAC Risk Score'] ?? "";
                        $allReports->nocac_riskscore = $data['Non CAC Risk Score'] ?? "";
                       /** $allReports->biological_age = $biologicalage ?? ""; **/
                        /**$allReports->chances_of_dying = $chanceofdying ?? "";**/

						$phenotypic_age_demo = $allReports->phenotypic_age();
						$allReports->biological_age = $phenotypic_age_demo['biological_age'];
						$allReports->chances_of_dying = $phenotypic_age_demo['chances_of_dying'];

						// for fetch bioage and labage
						$lab_age_report = $allReports->lab_age_report();
						$allReports->lab_age = $lab_age_report['lab_age'];


						$heart_age_report = $allReports->heart_age_report();
						$allReports->heart_age = $heart_age_report['heart_age'];

						// for fetchbio_age report
						$balance_age_report = $allReports->balance_age_report();
						$allReports->balance_age = $balance_age_report['balance_age'];
						// dd($record->balance_age);
						$grip_strength = $allReports->grip_strength();
						$allReports->equivalent_age_for_grip_strength = $grip_strength['equivalent_age_for_grip_strength'];
						// dd($record->equivalent_age_for_grip_strength);

						$musculoskeletal_age_report = $allReports->musculoskeletal_age_report();
						$allReports->musculoskeletal_age = $musculoskeletal_age_report['musculoskeletal_age'];

						$brain_age_report = $allReports->brain_age_report();
						$allReports->brain_age = $brain_age_report['brain_age'];
						// dd($record->brain_age);
						$bio_age_report = $allReports->bio_age_report();
						$allReports->bio_age = $bio_age_report['bio_age'];

						$risk_score = $allReports->risk_score();

                        $allReports->albumin_liver = $data['Albumin'] ?? "";
                        $allReports->alp_liver = $data['ALP (Alkaline Phosphatase)'] ?? "";
                        $allReports->creatinine_kidney = $data['Creatinine'] ?? "";
                        $allReports->crp_immune = $data['CRP Immune'] ?? "";
                        $allReports->lympho_immune = $data['Lympho Immune'] ?? "";
                        $allReports->mcv_bone_marrow = $data['Mcv Bone Marrow'] ?? "";
                        $allReports->rdw_bone_marrow = $data['rdw'] ?? "";
                        $allReports->pwv = $data['pmv'] ?? "";
                        $allReports->imt = $data['imt'] ?? "";
                        $allReports->pr_interval = $data['PR Interval'] ?? "";
                        $allReports->hr_bp_average = $data['Hr bp average'] ?? "";
                        $allReports->hr_bp_average_dbp = $data['Hr bp average dbp'] ?? "";
                        $allReports->skin_age = $data['skin_age'] ?? "";
                        $allReports->left_breast_thermography = $data['Left Breast Thermography'] ?? "";
                        $allReports->right_breast_thermography = $data['Right Breast Thermography'] ?? "";
                        $allReports->tanita_metabolic_age =$data['Tanita Metabolic Age'] ?? "";
                        $allReports->bf_percent = $data['Bf Percent'] ?? "";
                        $allReports->vo_2_max = $data['Vo2max'] ?? "";
                        $allReports->trudiagnostic_truage =$data['Trudiagnostic Truage'] ?? "";
                        $allReports->sleep_ahi = $data['Sleep Ahi'] ?? "";
                        $allReports->hrv = $data['hrv'] ?? "";

                        //$allReports->followup = $followup;
                        $allReports->hs_crp = $data['hs-CRP'] ?? "";
				        $allReports->oxldl = $data['OxLDL'] ?? "";
				        $allReports->estimated_average_glucose = $data['Estimated Average Glucose'] ?? "";
				        $allReports->hba1c = $data['HbA1c'] ?? "";
				        $allReports->homocysteine = $data['Homocysteine'] ?? "";
				        $allReports->egfr = $data['eGFR'] ?? "";
				        $allReports->testosterone = $data['Testosterone'] ?? "";
				        $allReports->testosterone_free = $data['Testosterone, Free'] ?? "";
				        $allReports->testosterone_free_pt = $data['Testosterone, % Free'] ?? "";
				        $allReports->shbg = $data['Sex Hormone Binding Globulin'] ?? "";
				        $allReports->ferritin = $data['Ferritin'] ?? "";
				        $allReports->prostatic_specific_ag	 = $data['Prostatic Specific Ag, Total'] ?? "";
                        $allReports->cholesterol_total = $data['Cholesterol, Total'] ?? "";
                        $allReports->hdl_cholesterol = $data['HDL Cholesterol'] ?? "";
                        $allReports->triglycerides = $data['Triglycerides'] ?? "";
                        $allReports->ldl_cholesterol_calculated = $data['LDL Cholesterol, Calculated'] ?? "";
                        $allReports->chol_hdl_c = $data['Chol/HDL-C'] ?? "";
                        $allReports->non_hdl_cholesterol = $data['Non-HDL Cholesterol'] ?? "";
                        $allReports->tg_hdl_c = $data['TG/HDL-C'] ?? "";
                        $allReports->ldl_p = $data['LDL-P(4)'] ?? "";
                        $allReports->small_ldl_p = $data['Small LDL-P'] ?? "";
                        $allReports->ldl_size = $data['LDL Size'] ?? "";
                        $allReports->hdl_p = $data['HDL-P'] ?? "";
                        $allReports->large_hdl_p = $data['Large HDL-P'] ?? "";
                        $allReports->hdl_size = $data['HDL Size'] ?? "";
                        $allReports->vldl_size = $data['VLDL Size'] ?? "";
                        $allReports->large_vldl_p = $data['Large VLDL-P'] ?? "";
                        $allReports->vitamin_d = $data['Vitamin D, 25-Hydroxy by LC-MS'] ?? "";
                        $allReports->omegacheck = $data['Whole Blood: EPA DPA DHA'] ?? "";
                        $allReports->arachidonic_acid_epa_ratio = $data['Arachidonic Acid/EPA Ratio'] ?? "";
                        $allReports->omega6_omega3_ratio = $data['Omega-6/Omega-3 Ratio'] ?? "";
                        $allReports->omega3_total = $data['Omega-3 total'] ?? "";
                        $allReports->epa = $data['EPA'] ?? "";
                        $allReports->dpa = $data['DPA'] ?? "";
                        $allReports->dha = $data['DHA'] ?? "";
                        $allReports->omega6_total = $data['Omega-6 total'] ?? "";
                        $allReports->arachidonic_acid = $data['Arachidonic Acid'] ?? "";
                        $allReports->linoleic_acid = $data['Linoleic Acid'] ?? "";
                        $allReports->co2 = $data['Bicarbonate'] ?? "";
                        $allReports->bun = $data['Blood-Urea-Nitrogen'] ?? "";
                        $allReports->creatinine = $data['Creatinine'] ?? "";

                        $allReports->calcium = $data['Calcium-Total'] ?? "";
                        $allReports->sodium = $data['Sodium'] ?? "";
                        $allReports->potassium = $data['Potassium'] ?? "";
                        $allReports->chloride = $data['Chloride'] ?? "";
                        $allReports->bun_creatinine_ratio = $data['BUN/Creatinine Ratio'] ?? "";
                        $allReports->protein = $data['Protein, Total'] ?? "";
                        $allReports->albumin = $data['Albumin'] ?? "";
                        $allReports->globulin = $data['Globulin'] ?? "";
                        $allReports->albumin_globulin_ratio = $data['Albumin/Globulin Ratio'] ?? "";
                        $allReports->alp = $data['ALP (Alkaline Phosphatase)'] ?? "";
                        $allReports->alt = $data['ALT (Alanine Amino Transferase)'] ?? "";
                        $allReports->ast = $data['AST (Aspartate Amino Transferase)'] ?? "";
                        $allReports->egfr_african_descent = $data['eGFR, African descent'] ?? "";
                        $allReports->bilirubin = $data['Bilirubin, Total'] ?? "";
                        $allReports->egfr_non_african_descent = $data['eGFR, Non-African descent'] ?? "";
                        $allReports->dhea_s = $data['DHEA-S'] ?? "";
                        $allReports->thyroid_stimulating_hormone = $data['Thyroid Stimulating Hormone 3'] ?? "";
                        $allReports->thyroxine = $data['Thyroxine (T4), Free'] ?? "";
                        $allReports->thyroid_peroxidase_ab = $data['Thyroid Peroxidase Ab'] ?? "";
                        $allReports->wbc = $data['WBC'] ?? "";
                        $allReports->rbc = $data['RBC'] ?? "";
                        $allReports->hemoglobin = $data['Hemoglobin'] ?? "";
                        $allReports->hematocrit = $data['Hematocrit'] ?? "";
                        $allReports->mcv = $data['MCV'] ?? "";
                        $allReports->mch = $data['MCH'] ?? "";
                        $allReports->mchc = $data['MCHC'] ?? "";
                        $allReports->rcdw = $data['Red Cell Distribution Width'] ?? "";
                        $allReports->platelet_count = $data['Platelet Count'] ?? "";
                        $allReports->mean_platelet_volume = $data['Mean Platelet Volume'] ?? "";
                        $allReports->neutrophil = $data['Neutrophil %'] ?? "";
                        $allReports->neutrophil_absolute = $data['Neutrophil Absolute'] ?? "";
                        $allReports->lymphocyte = $data['Lymphocyte %'] ?? "";
                        $allReports->lymphocyte_absolute = $data['Lymphocyte Absolute'] ?? "";
                        $allReports->monocyte = $data['Monocyte %'] ?? "";
                        $allReports->monocyte_absolute = $data['Monocyte Absolute'] ?? "";
                        $allReports->eosinophil = $data['Eosinophil %'] ?? "";
                        $allReports->eosinophil_absolute = $data['Eosinophil Absolute'] ?? "";
                        $allReports->basophil = $data['Basophil %'] ?? "";
                        $allReports->basophil_absolute = $data['Basophil Absolute'] ?? "";
                        $allReports->glucose = $data['Glucose'] ?? "";
                    }
					$allReports->user_id = Auth::id();
                    $allReports->patient_id = $patientId;
                    $allReports->name = $firstName." ".$lastName;
					$allReports->first_name = $firstName;
					$allReports->last_name = $lastName;
                    $allReports->report_type = $request->report_type;
					$timestamp = date('d-m-Y h:i:s A', time());
					$dateTime = Carbon::parse($timestamp, 'Asia/Kolkata');
					$formattedDateTime = $dateTime->format('d-m-Y h:i:s A');
					$allReports->created_at = $formattedDateTime;
					//dd($allReports);
                    $allReports->save();

                        $today = date("Y-m-d");
                        $diff = date_diff(
                            date_create($data['DOB']),
                            date_create($today)
                        );
                        $age = $diff->format("%y");
                        $patient->age = $data['Age'];
                        $patient->birthday = $data['DOB'];
                        $patient->gender = $data['Gender'];
						$patient->phone = $data['Phone'];
				// 		$patient->provider_name = $provider_name;
						$patient->patient_type = "existing";
                        $patient->save();
                }
            } elseif ($patientType === "new_patient") {
				
                if ($request->has("new_patient_type")) {
					
                    $newPatientType = $request->new_patient_type;
                    $patient = Patient::find($request->patient_id);
                    if ($newPatientType === "default" && !empty($data['Patient Name'])) {
						dd($request->new_patient_type);
                       /** $allReports->name = $patient_name;
						$allReports->first_name = $first_name;
						$allReports->last_name = $last_name;**/
						//dd($firstName,$lastName);
                        $newPatient = new Patient();
						$newPatient->user_id = Auth::id();
                        $newPatient->first_name = $first_name;
                        $newPatient->last_name = $last_name;
                        $today = date("Y-m-d");
                        $diff = date_diff(
                            date_create($data['DOB']),
                            date_create($today)
                        );
                        $age = $diff->format("%y");
                        // $newPatient->name = $data['Patient Name'];
                        $newPatient->age = $data['DOB'];
						$newPatient->phone = $data['Phone'];
                        $newPatient->birthday = $data['DOB'];
                        $newPatient->gender = $data['Gender'];
				// 		$newPatient->provider_name = $provider_name;
                        $newPatient->patient_type = "new_patient";
						//dd($newPatient);
                        $newPatient->save();
                        $patientId = $newPatient->id;
                        // for bioage end
                        if ($request->report_type === "bioage_report") {
                            $allReports = new Report($request->all());
                            $patient = Patient::find($patientId);

                            if ($patient) {
                                $patientId = $patient->id;
                                $initialReport = Report::where('patient_id', $patientId)
                                                                       ->where('followup', 'Initial')
                                                                       ->first(); // Retrieve the initial report
                                if($initialReport) {
                                    $totalcount = Report::where('patient_id', $patientId)
                                                                          ->where('followup', 'like', 'followup-%')
                                                                          ->count();

                                    $count = $totalcount + 1;
									$followup = "followup-".$count;
                                    $allReports->followup =  $followup;
                                } else {
                                    $followup = "Initial";
                                    $allReports->followup =  $followup;
                                }
                            } else {
                                echo "patient not found";
                            }
						$allReports->user_id = Auth::id();
						$allReports->name = $patient_name;
						$allReports->first_name = $first_name;
						$allReports->last_name = $last_name;
				// 		$allReports->provider_name = $provider_name;
                        $allReports->cac = $data['cac'];
                        $allReports->right_hand_est_grip_strength = $data['Right Hand Est Grip Strength'];
                        $allReports->fev_1 = $data['Fev 1'];
                        $allReports->chol = $data['Cholesterol, Total'];
                        $allReports->hdl = $data['HDL Cholesterol'];
                        $phenotypic_age_demo = $allReports->phenotypic_age();
						$allReports->biological_age = $phenotypic_age_demo['biological_age'];
						$allReports->chances_of_dying = $phenotypic_age_demo['chances_of_dying'];


						$risk_score = $allReports->risk_score();
						$allReports->cac_riskscore = isset($risk_score['cac_riskscore']) ? $risk_score['cac_riskscore'] : null;
						$allReports->nocac_riskscore = isset($risk_score['nocac_riskscore']) ? $risk_score['nocac_riskscore'] : null;

						//dd($risk_score);

						$arterial_age = $allReports->arterial_age();
						$allReports->arterial_age = $arterial_age['arterial_age'];
						//dd($report->arterial_age)	;

						$lung_age = $allReports->lung_age();
						$allReports->lung_age = $lung_age['age'];
						//dd($report->lung_age);

						// for fetch bioage and labage
						$lab_age_report = $allReports->lab_age_report();
						$allReports->lab_age = $lab_age_report['lab_age'];


						$heart_age_report = $allReports->heart_age_report();
						$allReports->heart_age = $heart_age_report['heart_age'];

						// for fetchbio_age report
						$balance_age_report = $allReports->balance_age_report();
						$allReports->balance_age = $balance_age_report['balance_age'];
						// dd($record->balance_age);

						$grip_strength = $allReports->grip_strength();
						$allReports->equivalent_age_for_grip_strength = $grip_strength['equivalent_age_for_grip_strength'];
									// dd($record->equivalent_age_for_grip_strength);

						$musculoskeletal_age_report = $allReports->musculoskeletal_age_report();
						$allReports->musculoskeletal_age = $musculoskeletal_age_report['musculoskeletal_age'];
						//dd($report->musculoskeletal_age);

						$brain_age_report = $allReports->brain_age_report();
						$allReports->brain_age = $brain_age_report['brain_age'];
									// dd($record->brain_age);

						$vascular_age_report = $allReports->vascular_age_report();
						$allReports->vascular_age = $vascular_age_report['vascular_age'];

						$vascular_age_report_2 = $allReports->vascular_age_report_2();
						$allReports->vascular_age_2 = $vascular_age_report_2['vascular_age_2'];
						$allReports->percentile = $vascular_age_report_2['percentile'];

						$ekg_heart_age_report = $allReports->ekg_heart_age_report();
						$allReports->ekg_heart_age = $ekg_heart_age_report['ekg_heart_age'];

						$bio_age_report = $allReports->bio_age_report();
						$allReports->bio_age = $bio_age_report['bio_age'];

                        $allReports->albumin_liver = $data['Albumin'] ?? "";
                        $allReports->alp_liver = $data['ALP (Alkaline Phosphatase)'] ?? "";
                        $allReports->creatinine_kidney = $data['Creatinine'] ?? "";
                        $allReports->crp_immune = $data['CRP Immune'] ?? "";
                        $allReports->lympho_immune = $data['Lympho Immune'] ?? "";
                        $allReports->mcv_bone_marrow = $data['Mcv Bone Marrow'] ?? "";
                        $allReports->rdw_bone_marrow = $data['rdw'] ?? "";
                        $allReports->pwv = $data['pmv'] ?? "";
                        $allReports->imt = $data['imt'] ?? "";
                        $allReports->pr_interval = $data['PR Interval'] ?? "";
                        $allReports->hr_bp_average = $data['Hr bp average'] ?? "";
                        $allReports->hr_bp_average_dbp = $data['Hr bp average dbp'] ?? "";
                        $allReports->skin_age = $data['skin_age'] ?? "";
                        $allReports->left_breast_thermography = $data['Left Breast Thermography'] ?? "";
                        $allReports->right_breast_thermography = $data['Right Breast Thermography'] ?? "";
                        $allReports->tanita_metabolic_age =$data['Tanita Metabolic Age'] ?? "";
                        $allReports->bf_percent = $data['Bf Percent'] ?? "";
                        $allReports->vo_2_max = $data['Vo2max'] ?? "";
                        $allReports->trudiagnostic_truage =$data['Trudiagnostic Truage'] ?? "";
                        $allReports->sleep_ahi = $data['Sleep Ahi'] ?? "";
                        $allReports->hrv = $data['hrv'] ?? "";
                        } elseif ($request->report_type === "lab_report") {
                            $allReports = new Cardiometabolicreport($request->all());
                            $patient = Patient::find($patientId);

                            if ($patient) {
                                $patientId = $patient->id;
                                $initialReport = Cardiometabolicreport::where('patient_id', $patientId)
                                                                       ->where('followup', 'Initial')
                                                                       ->first(); // Retrieve the initial report
                                if($initialReport) {
                                    $totalcount = Cardiometabolicreport::where('patient_id', $patientId)
                                                                          ->where('followup', 'like', 'followup-%')
                                                                          ->count();

                                    $count = $totalcount + 1;
									$followup = "followup-".$count;
                                    $allReports->followup =  $followup;
                                } else {
                                    $followup = "Initial";
                                    $allReports->followup =  $followup;
                                }
                            } else {
                                echo "patient not found";
                            }

						//$allReports->followup = $followup;
						$allReports->user_id = Auth::id();
						$allReports->name = $patient_name;
						$allReports->first_name = $first_name;
						$allReports->last_name = $last_name;
						$allReports->hs_crp = $data['hs-CRP'] ?? "";
				        $allReports->oxldl = $data['OxLDL'] ?? "";
				        $allReports->estimated_average_glucose = $data['Estimated Average Glucose'] ?? "";
				        $allReports->hba1c = $data['HbA1c'] ?? "";
				        $allReports->homocysteine = $data['Homocysteine'] ?? "";
				        $allReports->egfr = $data['eGFR'] ?? "";
				        $allReports->testosterone = $data['Testosterone'] ?? "";
				        $allReports->testosterone_free = $data['Testosterone, Free'] ?? "";
				        $allReports->testosterone_free_pt = $data['Testosterone, % Free'] ?? "";
				        $allReports->shbg = $data['Sex Hormone Binding Globulin'] ?? "";
				        $allReports->ferritin = $data['Ferritin'] ?? "";
				        $allReports->prostatic_specific_ag	 = $data['Prostatic Specific Ag, Total'] ?? "";
				// 		$allReports->provider_name = $provider_name;
                        $allReports->cholesterol_total = $data['Cholesterol, Total'] ?? "";
                        $allReports->hdl_cholesterol = $data['HDL Cholesterol'] ?? "";
                        $allReports->triglycerides = $data['Triglycerides'] ?? "";
                        $allReports->ldl_cholesterol_calculated = $data['LDL Cholesterol, Calculated'] ?? "";
                        $allReports->chol_hdl_c = $data['Chol/HDL-C'] ?? "";
                        $allReports->non_hdl_cholesterol = $data['Non-HDL Cholesterol'] ?? "";
                        $allReports->tg_hdl_c = $data['TG/HDL-C'] ?? "";
                        $allReports->ldl_p = $data['LDL-P(4)'] ?? "";
                        $allReports->small_ldl_p = $data['Small LDL-P'] ?? "";
                        $allReports->ldl_size = $data['LDL Size'] ?? "";
                        $allReports->hdl_p = $data['HDL-P'] ?? "";
                        $allReports->large_hdl_p = $data['Large HDL-P'] ?? "";
                        $allReports->hdl_size = $data['HDL Size'] ?? "";
                        $allReports->vldl_size = $data['VLDL Size'] ?? "";
                        $allReports->large_vldl_p = $data['Large VLDL-P'] ?? "";
                        $allReports->vitamin_d = $data['Vitamin D, 25-Hydroxy by LC-MS'] ?? "";
                        $allReports->omegacheck = $data['Whole Blood: EPA DPA DHA'] ?? "";
                        $allReports->arachidonic_acid_epa_ratio = $data['Arachidonic Acid/EPA Ratio'] ?? "";
                        $allReports->omega6_omega3_ratio = $data['Omega-6/Omega-3 Ratio'] ?? "";
                        $allReports->omega3_total = $data['Omega-3 total'] ?? "";
                        $allReports->epa = $data['EPA'] ?? "";
                        $allReports->dpa = $data['DPA'] ?? "";
                        $allReports->dha = $data['DHA'] ?? "";
                        $allReports->omega6_total = $data['Omega-6 total'] ?? "";
                        $allReports->arachidonic_acid = $data['Arachidonic Acid'] ?? "";
                        $allReports->linoleic_acid = $data['Linoleic Acid'] ?? "";
                        $allReports->co2 = $data['Bicarbonate'] ?? "";
                        $allReports->bun = $data['Blood-Urea-Nitrogen'] ?? "";
                        $allReports->creatinine = $data['Creatinine'] ?? "";

                        $allReports->calcium = $data['Calcium-Total'] ?? "";
                        $allReports->sodium = $data['Sodium'] ?? "";
                        $allReports->potassium = $data['Potassium'] ?? "";
                        $allReports->chloride = $data['Chloride'] ?? "";
                        $allReports->bun_creatinine_ratio = $data['BUN/Creatinine Ratio'] ?? "";
                        $allReports->protein = $data['Protein, Total'] ?? "";
                        $allReports->albumin = $data['Albumin'] ?? "";
                        $allReports->globulin = $data['Globulin'] ?? "";
                        $allReports->albumin_globulin_ratio = $data['Albumin/Globulin Ratio'] ?? "";
                        $allReports->alp = $data['ALP (Alkaline Phosphatase)'] ?? "";
                        $allReports->alt = $data['ALT (Alanine Amino Transferase)'] ?? "";
                        $allReports->ast = $data['AST (Aspartate Amino Transferase)'] ?? "";
                        $allReports->egfr_african_descent = $data['eGFR, African descent'] ?? "";
                        $allReports->bilirubin = $data['Bilirubin, Total'] ?? "";
                        $allReports->egfr_non_african_descent = $data['eGFR, Non-African descent'] ?? "";
                        $allReports->dhea_s = $data['DHEA-S'] ?? "";
                        $allReports->thyroid_stimulating_hormone = $data['Thyroid Stimulating Hormone 3'] ?? "";
                        $allReports->thyroxine = $data['Thyroxine (T4), Free'] ?? "";
                        $allReports->thyroid_peroxidase_ab = $data['Thyroid Peroxidase Ab'] ?? "";
                        $allReports->wbc = $data['WBC'] ?? "";
                        $allReports->rbc = $data['RBC'] ?? "";
                        $allReports->hemoglobin = $data['Hemoglobin'] ?? "";
                        $allReports->hematocrit = $data['Hematocrit'] ?? "";
                        $allReports->mcv = $data['MCV'] ?? "";
                        $allReports->mch = $data['MCH'] ?? "";
                        $allReports->mchc = $data['MCHC'] ?? "";
                        $allReports->rcdw = $data['Red Cell Distribution Width'] ?? "";
                        $allReports->platelet_count = $data['Platelet Count'] ?? "";
                        $allReports->mean_platelet_volume = $data['Mean Platelet Volume'] ?? "";
                        $allReports->neutrophil = $data['Neutrophil %'] ?? "";
                        $allReports->neutrophil_absolute = $data['Neutrophil Absolute'] ?? "";
                        $allReports->lymphocyte = $data['Lymphocyte %'] ?? "";
                        $allReports->lymphocyte_absolute = $data['Lymphocyte Absolute'] ?? "";
                        $allReports->monocyte = $data['Monocyte %'] ?? "";
                        $allReports->monocyte_absolute = $data['Monocyte Absolute'] ?? "";
                        $allReports->eosinophil = $data['Eosinophil %'] ?? "";
                        $allReports->eosinophil_absolute = $data['Eosinophil Absolute'] ?? "";
                        $allReports->basophil = $data['Basophil %'] ?? "";
                        $allReports->basophil_absolute = $data['Basophil Absolute'] ?? "";
                        $allReports->glucose = $data['Glucose'] ?? "";

                        } elseif ($request->report_type === "combine_report") {
                            $allReports = new Allreport($request->all());
                            $patient = Patient::find($patientId);
                            if ($patient) {
                                $patientId = $patient->id;
                                $initialReport = Allreport::where('patient_id', $patientId)
                                                                       ->where('followup', 'Initial')
                                                                       ->first(); // Retrieve the initial report
                                if($initialReport) {
                                    $totalcount = Allreport::where('patient_id', $patientId)
                                                                          ->where('followup', 'like', 'followup-%')
                                                                          ->count();

                                    $count = $totalcount + 1;
									$followup = "followup-".$count;
                                    $allReports->followup =  $followup;
                                } else {
                                    $followup = "Initial";
                                    $allReports->followup =  $followup;
                                }
                            } else {
                                echo "patient not found";
                            }

						$allReports->user_id = Auth::id();
						$allReports->name = $patient_name;
						$allReports->first_name = $first_name;
						$allReports->last_name = $last_name;
				// 		$allReports->provider_name = $provider_name;
                        $allReports->cac = $data['cac'];
                        $allReports->right_hand_est_grip_strength = $data['Right Hand Est Grip Strength'];
                        $allReports->fev_1 = $data['Fev 1'];
                        $allReports->chol = $data['Cholesterol, Total'];
                        $allReports->hdl = $data['HDL Cholesterol'];
                        $allReports->cac_riskscore = $data['CAC Risk Score'] ?? "";
                        $allReports->nocac_riskscore = $data['Non CAC Risk Score'] ?? "";
                       /** $allReports->biological_age = $biologicalage ?? "";**/
                         /**$allReports->chances_of_dying = $chanceofdying ?? "";**/

						$phenotypic_age_demo = $allReports->phenotypic_age();
						$allReports->biological_age = $phenotypic_age_demo['biological_age'];
						$allReports->chances_of_dying = $phenotypic_age_demo['chances_of_dying'];

						// for fetch bioage and labage
						$lab_age_report = $allReports->lab_age_report();
						$allReports->lab_age = $lab_age_report['lab_age'];


						$heart_age_report = $allReports->heart_age_report();
						$allReports->heart_age = $heart_age_report['heart_age'];

						// for fetchbio_age report
						$balance_age_report = $allReports->balance_age_report();
						$allReports->balance_age = $balance_age_report['balance_age'];
						// dd($record->balance_age);
						$grip_strength = $allReports->grip_strength();
						$allReports->equivalent_age_for_grip_strength = $grip_strength['equivalent_age_for_grip_strength'];
						// dd($record->equivalent_age_for_grip_strength);

						$musculoskeletal_age_report = $allReports->musculoskeletal_age_report();
						$allReports->musculoskeletal_age = $musculoskeletal_age_report['musculoskeletal_age'];

						$brain_age_report = $allReports->brain_age_report();
						$allReports->brain_age = $brain_age_report['brain_age'];
						// dd($record->brain_age);
						$bio_age_report = $allReports->bio_age_report();
						$allReports->bio_age = $bio_age_report['bio_age'];

						$risk_score = $allReports->risk_score();

                        $allReports->albumin_liver = $data['Albumin'] ?? "";
                        $allReports->alp_liver = $data['ALP (Alkaline Phosphatase)'] ?? "";
                        $allReports->creatinine_kidney = $data['Creatinine'] ?? "";
                        $allReports->crp_immune = $data['CRP Immune'] ?? "";
                        $allReports->lympho_immune = $data['Lympho Immune'] ?? "";
                        $allReports->mcv_bone_marrow = $data['Mcv Bone Marrow'] ?? "";
                        $allReports->rdw_bone_marrow = $data['rdw'] ?? "";
                        $allReports->pwv = $data['pmv'] ?? "";
                        $allReports->imt = $data['imt'] ?? "";
                        $allReports->pr_interval = $data['PR Interval'] ?? "";
                        $allReports->hr_bp_average = $data['Hr bp average'] ?? "";
                        $allReports->hr_bp_average_dbp = $data['Hr bp average dbp'] ?? "";
                        $allReports->skin_age = $data['skin_age'] ?? "";
                        $allReports->left_breast_thermography = $data['Left Breast Thermography'] ?? "";
                        $allReports->right_breast_thermography = $data['Right Breast Thermography'] ?? "";
                        $allReports->tanita_metabolic_age =$data['Tanita Metabolic Age'] ?? "";
                        $allReports->bf_percent = $data['Bf Percent'] ?? "";
                        $allReports->vo_2_max = $data['Vo2max'] ?? "";
                        $allReports->trudiagnostic_truage =$data['Trudiagnostic Truage'] ?? "";
                        $allReports->sleep_ahi = $data['Sleep Ahi'] ?? "";
                        $allReports->hrv = $data['hrv'] ?? "";

                            // lab report
                       //$allReports->followup = $followup;
				// 		$allReports->provider_name = $provider_name;
                        $allReports->cholesterol_total = $data['Cholesterol, Total'] ?? "";
                        $allReports->hdl_cholesterol = $data['HDL Cholesterol'] ?? "";
                        $allReports->triglycerides = $data['Triglycerides'] ?? "";
                        $allReports->ldl_cholesterol_calculated = $data['LDL Cholesterol, Calculated'] ?? "";
                        $allReports->chol_hdl_c = $data['Chol/HDL-C'] ?? "";
                        $allReports->non_hdl_cholesterol = $data['Non-HDL Cholesterol'] ?? "";
                        $allReports->tg_hdl_c = $data['TG/HDL-C'] ?? "";
                        $allReports->ldl_p = $data['LDL-P(4)'] ?? "";
                        $allReports->small_ldl_p = $data['Small LDL-P'] ?? "";
                        $allReports->ldl_size = $data['LDL Size'] ?? "";
                        $allReports->hdl_p = $data['HDL-P'] ?? "";
                        $allReports->large_hdl_p = $data['Large HDL-P'] ?? "";
                        $allReports->hdl_size = $data['HDL Size'] ?? "";
                        $allReports->vldl_size = $data['VLDL Size'] ?? "";
                        $allReports->large_vldl_p = $data['Large VLDL-P'] ?? "";
                        $allReports->vitamin_d = $data['Vitamin D, 25-Hydroxy by LC-MS'] ?? "";
                        $allReports->omegacheck = $data['Whole Blood: EPA DPA DHA'] ?? "";
                        $allReports->arachidonic_acid_epa_ratio = $data['Arachidonic Acid/EPA Ratio'] ?? "";
                        $allReports->omega6_omega3_ratio = $data['Omega-6/Omega-3 Ratio'] ?? "";
                        $allReports->omega3_total = $data['Omega-3 total'] ?? "";
                        $allReports->epa = $data['EPA'] ?? "";
                        $allReports->dpa = $data['DPA'] ?? "";
                        $allReports->dha = $data['DHA'] ?? "";
                        $allReports->omega6_total = $data['Omega-6 total'] ?? "";
                        $allReports->arachidonic_acid = $data['Arachidonic Acid'] ?? "";
                        $allReports->linoleic_acid = $data['Linoleic Acid'] ?? "";
                        $allReports->co2 = $data['Bicarbonate'] ?? "";
                        $allReports->bun = $data['Blood-Urea-Nitrogen'] ?? "";
                        $allReports->creatinine = $data['Creatinine'] ?? "";
                        $allReports->calcium = $data['Calcium-Total'] ?? "";
                        $allReports->sodium = $data['Sodium'] ?? "";
                        $allReports->potassium = $data['Potassium'] ?? "";
                        $allReports->chloride = $data['Chloride'] ?? "";
                        $allReports->bun_creatinine_ratio = $data['BUN/Creatinine Ratio'] ?? "";
                        $allReports->protein = $data['Protein, Total'] ?? "";
                        $allReports->albumin = $data['Albumin'] ?? "";
                        $allReports->globulin = $data['Globulin'] ?? "";
                        $allReports->albumin_globulin_ratio = $data['Albumin/Globulin Ratio'] ?? "";
                        $allReports->alp = $data['ALP (Alkaline Phosphatase)'] ?? "";
                        $allReports->alt = $data['ALT (Alanine Amino Transferase)'] ?? "";
                        $allReports->ast = $data['AST (Aspartate Amino Transferase)'] ?? "";
                        $allReports->egfr_african_descent = $data['eGFR, African descent'] ?? "";
                        $allReports->bilirubin = $data['Bilirubin, Total'] ?? "";
                        $allReports->egfr_non_african_descent = $data['eGFR, Non-African descent'] ?? "";
                        $allReports->dhea_s = $data['DHEA-S'] ?? "";
                        $allReports->thyroid_stimulating_hormone = $data['Thyroid Stimulating Hormone 3'] ?? "";
                        $allReports->thyroxine = $data['Thyroxine (T4), Free'] ?? "";
                        $allReports->thyroid_peroxidase_ab = $data['Thyroid Peroxidase Ab'] ?? "";
                        $allReports->wbc = $data['WBC'] ?? "";
                        $allReports->rbc = $data['RBC'] ?? "";
                        $allReports->hemoglobin = $data['Hemoglobin'] ?? "";
                        $allReports->hematocrit = $data['Hematocrit'] ?? "";
                        $allReports->mcv = $data['MCV'] ?? "";
                        $allReports->mch = $data['MCH'] ?? "";
                        $allReports->mchc = $data['MCHC'] ?? "";
                        $allReports->rcdw = $data['Red Cell Distribution Width'] ?? "";
                        $allReports->platelet_count = $data['Platelet Count'] ?? "";
                        $allReports->mean_platelet_volume = $data['Mean Platelet Volume'] ?? "";
                        $allReports->neutrophil = $data['Neutrophil %'] ?? "";
                        $allReports->neutrophil_absolute = $data['Neutrophil Absolute'] ?? "";
                        $allReports->lymphocyte = $data['Lymphocyte %'] ?? "";
                        $allReports->lymphocyte_absolute = $data['Lymphocyte Absolute'] ?? "";
                        $allReports->monocyte = $data['Monocyte %'] ?? "";
                        $allReports->monocyte_absolute = $data['Monocyte Absolute'] ?? "";
                        $allReports->eosinophil = $data['Eosinophil %'] ?? "";
                        $allReports->eosinophil_absolute = $data['Eosinophil Absolute'] ?? "";
                        $allReports->basophil = $data['Basophil %'] ?? "";
                        $allReports->basophil_absolute = $data['Basophil Absolute'] ?? "";
                        $allReports->glucose = $data['Glucose'] ?? "";

                        }
                        $allReports->patient_id = $patientId;
				// 		$allReports->name = $nameWithoutComma;
						$allReports->name = $patient_name;
						$allReports->first_name = $first_name;
						$allReports->last_name = $last_name;
						$allReports->report_type = $request->report_type;
                        $allReports->save();

                    } elseif (
                        $newPatientType === "patient_name" &&
                        $request->has("new_patient_name")
                    ) {
						$nameParts = explode(" ", $request->new_patient_name);
						dd('Hello');
                        $lastName = trim($nameParts[0]);
                        $firstName = ltrim(
                            implode(" ", array_slice($nameParts, 1))
                        );
						//dd($firstName, $lastName);
                        $newPatient = new Patient();
						$newPatient->user_id = Auth::id();
						$newPatient->first_name = $firstName;
						$newPatient->last_name = $lastName;
                        $today = date("Y-m-d");
                        $diff = date_diff(
                            date_create($data['DOB']),
                            date_create($today)
                        );
                        $age = $diff->format("%y");
                        $newPatient->age = $data['Age'];
						$newPatient->phone = $data['Phone'];
                        $newPatient->birthday = $data['DOB'];
                        $newPatient->gender = $data['Gender'];
				// 		$newPatient->provider_name = $provider_name;
                        $newPatient->patient_type = "new_patient";
                        $newPatient->save();
                        $patientId = $newPatient->id;
                        // for bioage end
                        if ($request->report_type === "bioage_report") {
							$nameParts = explode(" ", $request->new_patient_name);
							$lastName = trim($nameParts[0]);
							$firstName = ltrim(
								implode(" ", array_slice($nameParts, 1))
							);
                            $allReports = new Report($request->all());
                            $patient = Patient::find($patientId);
                            //dd($patient);

                            if ($patient) {
                                $patientId = $patient->id;
                                $initialReport = Report::where('patient_id', $patientId)
                                                                       ->where('followup', 'Initial')
                                                                       ->first(); // Retrieve the initial report
                                if($initialReport) {
                                    $totalcount = Report::where('patient_id', $patientId)
                                                                          ->where('followup', 'like', 'followup-%')
                                                                          ->count();

                                    $count = $totalcount + 1;
									$followup = "followup-".$count;
                                    $allReports->followup =  $followup;
                                } else {
                                    $followup = "Initial";
                                    $allReports->followup =  $followup;
                                }
                            } else {
                                echo "patient not found";
                            }
							$allReports->user_id = Auth::id();
				// 		$allReports->provider_name = $provider_name;
						$allReports->name = $request->new_patient_name;
						$allReports->first_name = $firstName;
						$allReports->last_name = $lastName;
                        $allReports->cac = $data['cac'];
                        $allReports->right_hand_est_grip_strength = $data['Right Hand Est Grip Strength'];
                        $allReports->fev_1 = $data['Fev 1'];
                        $allReports->chol = $data['Cholesterol, Total'];
                        $allReports->hdl = $data['HDL Cholesterol'];
                        $phenotypic_age_demo = $allReports->phenotypic_age();
						$allReports->biological_age = $phenotypic_age_demo['biological_age'];
						$allReports->chances_of_dying = $phenotypic_age_demo['chances_of_dying'];


						$risk_score = $allReports->risk_score();
						$allReports->cac_riskscore = isset($risk_score['cac_riskscore']) ? $risk_score['cac_riskscore'] : null;
						$allReports->nocac_riskscore = isset($risk_score['nocac_riskscore']) ? $risk_score['nocac_riskscore'] : null;

						//dd($risk_score);

						$arterial_age = $allReports->arterial_age();
						$allReports->arterial_age = $arterial_age['arterial_age'];
						//dd($report->arterial_age)	;

						$lung_age = $allReports->lung_age();
						$allReports->lung_age = $lung_age['age'];
						//dd($report->lung_age);

						// for fetch bioage and labage
						$lab_age_report = $allReports->lab_age_report();
						$allReports->lab_age = $lab_age_report['lab_age'];


						$heart_age_report = $allReports->heart_age_report();
						$allReports->heart_age = $heart_age_report['heart_age'];

						// for fetchbio_age report
						$balance_age_report = $allReports->balance_age_report();
						$allReports->balance_age = $balance_age_report['balance_age'];
						// dd($record->balance_age);

						$grip_strength = $allReports->grip_strength();
						$allReports->equivalent_age_for_grip_strength = $grip_strength['equivalent_age_for_grip_strength'];
									// dd($record->equivalent_age_for_grip_strength);

						$musculoskeletal_age_report = $allReports->musculoskeletal_age_report();
						$allReports->musculoskeletal_age = $musculoskeletal_age_report['musculoskeletal_age'];
						//dd($report->musculoskeletal_age);

						$brain_age_report = $allReports->brain_age_report();
						$allReports->brain_age = $brain_age_report['brain_age'];
									// dd($record->brain_age);

						$vascular_age_report = $allReports->vascular_age_report();
						$allReports->vascular_age = $vascular_age_report['vascular_age'];

						$vascular_age_report_2 = $allReports->vascular_age_report_2();
						$allReports->vascular_age_2 = $vascular_age_report_2['vascular_age_2'];
						$allReports->percentile = $vascular_age_report_2['percentile'];

						$ekg_heart_age_report = $allReports->ekg_heart_age_report();
						$allReports->ekg_heart_age = $ekg_heart_age_report['ekg_heart_age'];

						$bio_age_report = $allReports->bio_age_report();
						$allReports->bio_age = $bio_age_report['bio_age'];

                        $allReports->albumin_liver = $data['Albumin'] ?? "";
                        $allReports->alp_liver = $data['ALP (Alkaline Phosphatase)'] ?? "";
                        $allReports->creatinine_kidney = $data['Creatinine'] ?? "";
                        $allReports->crp_immune = $data['CRP Immune'] ?? "";
                        $allReports->lympho_immune = $data['Lympho Immune'] ?? "";
                        $allReports->mcv_bone_marrow = $data['Mcv Bone Marrow'] ?? "";
                        $allReports->rdw_bone_marrow = $data['rdw'] ?? "";
                        $allReports->pwv = $data['pmv'] ?? "";
                        $allReports->imt = $data['imt'] ?? "";
                        $allReports->pr_interval = $data['PR Interval'] ?? "";
                        $allReports->hr_bp_average = $data['Hr bp average'] ?? "";
                        $allReports->hr_bp_average_dbp = $data['Hr bp average dbp'] ?? "";
                        $allReports->skin_age = $data['skin_age'] ?? "";
                        $allReports->left_breast_thermography = $data['Left Breast Thermography'] ?? "";
                        $allReports->right_breast_thermography = $data['Right Breast Thermography'] ?? "";
                        $allReports->tanita_metabolic_age =$data['Tanita Metabolic Age'] ?? "";
                        $allReports->bf_percent = $data['Bf Percent'] ?? "";
                        $allReports->vo_2_max = $data['Vo2max'] ?? "";
                        $allReports->trudiagnostic_truage =$data['Trudiagnostic Truage'] ?? "";
                        $allReports->sleep_ahi = $data['Sleep Ahi'] ?? "";
                        $allReports->hrv = $data['hrv'] ?? "";
                           /** $allReports->biological_age = $biologicalage ?? "";**/
                         /**$allReports->chances_of_dying = $chanceofdying ?? "";**/
                        } elseif ($request->report_type === "lab_report") {
                        $allReports = new Cardiometabolicreport(
                            $request->all()
                        );

						$nameParts = explode(" ", $request->new_patient_name);
                        $lastName = trim($nameParts[0]);
                        $firstName = ltrim(
                            implode(" ", array_slice($nameParts, 1))
                        );
                        $patient = Patient::find($patientId);

                        if ($patient) {
                            $patientId = $patient->id;
                            $initialReport = Cardiometabolicreport::where('patient_id', $patientId)
                                                                   ->where('followup', 'Initial')
                                                                   ->first(); // Retrieve the initial report

                            if($initialReport) {
                                $totalcount = Cardiometabolicreport::where('patient_id', $patientId)
                                                                      ->where('followup', 'like', 'followup-%')
                                                                      ->count();

                                $count = $totalcount + 1;
								$followup = "followup-".$count;
                                $allReports->followup = $followup;
                            } else {
                                $followup = "Initial";
                                $allReports->followup = $followup;
                            }
                        } else {
                            echo "patient not found";
                        }


						//$allReports->followup = $followup;
						$allReports->user_id = Auth::id();
						$allReports->name = $request->new_patient_name;
						$allReports->first_name = $request->firstName;
						$allReports->last_name = $request->lastName;
							//dd($allReports->new_patient_name);
						$allReports->hs_crp = $data['hs-CRP'] ?? "";
				        $allReports->oxldl = $data['OxLDL'] ?? "";
				        $allReports->estimated_average_glucose = $data['Estimated Average Glucose'] ?? "";
				        $allReports->hba1c = $data['HbA1c'] ?? "";
				        $allReports->homocysteine = $data['Homocysteine'] ?? "";
				        $allReports->egfr = $data['eGFR'] ?? "";
				        $allReports->testosterone = $data['Testosterone'] ?? "";
				        $allReports->testosterone_free = $data['Testosterone, Free'] ?? "";
				        $allReports->testosterone_free_pt = $data['Testosterone, % Free'] ?? "";
				        $allReports->shbg = $data['Sex Hormone Binding Globulin'] ?? "";
				        $allReports->ferritin = $data['Ferritin'] ?? "";
				        $allReports->prostatic_specific_ag	 = $data['Prostatic Specific Ag, Total'] ?? "";
				// 		$allReports->provider_name = $provider_name;
                        $allReports->cholesterol_total = $data['Cholesterol, Total'] ?? "";
                        $allReports->hdl_cholesterol = $data['HDL Cholesterol'] ?? "";
                        $allReports->triglycerides = $data['Triglycerides'] ?? "";
                        $allReports->ldl_cholesterol_calculated = $data['LDL Cholesterol, Calculated'] ?? "";
                        $allReports->chol_hdl_c = $data['Chol/HDL-C'] ?? "";
                        $allReports->non_hdl_cholesterol = $data['Non-HDL Cholesterol'] ?? "";
                        $allReports->tg_hdl_c = $data['TG/HDL-C'] ?? "";
                        $allReports->ldl_p = $data['LDL-P(4)'] ?? "";
                        $allReports->small_ldl_p = $data['Small LDL-P'] ?? "";
                        $allReports->ldl_size = $data['LDL Size'] ?? "";
                        $allReports->hdl_p = $data['HDL-P'] ?? "";
                        $allReports->large_hdl_p = $data['Large HDL-P'] ?? "";
                        $allReports->hdl_size = $data['HDL Size'] ?? "";
                        $allReports->vldl_size = $data['VLDL Size'] ?? "";
                        $allReports->large_vldl_p = $data['Large VLDL-P'] ?? "";
                        $allReports->vitamin_d = $data['Vitamin D, 25-Hydroxy by LC-MS'] ?? "";
                        $allReports->omegacheck = $data['Whole Blood: EPA DPA DHA'] ?? "";
                        $allReports->arachidonic_acid_epa_ratio = $data['Arachidonic Acid/EPA Ratio'] ?? "";
                        $allReports->omega6_omega3_ratio = $data['Omega-6/Omega-3 Ratio'] ?? "";
                        $allReports->omega3_total = $data['Omega-3 total'] ?? "";
                        $allReports->epa = $data['EPA'] ?? "";
                        $allReports->dpa = $data['DPA'] ?? "";
                        $allReports->dha = $data['DHA'] ?? "";
                        $allReports->omega6_total = $data['Omega-6 total'] ?? "";
                        $allReports->arachidonic_acid = $data['Arachidonic Acid'] ?? "";
                        $allReports->linoleic_acid = $data['Linoleic Acid'] ?? "";
                        $allReports->co2 = $data['Bicarbonate'] ?? "";
                        $allReports->bun = $data['Blood-Urea-Nitrogen'] ?? "";
                        $allReports->creatinine = $data['Creatinine'] ?? "";
                        $allReports->calcium = $data['Calcium-Total'] ?? "";
                        $allReports->sodium = $data['Sodium'] ?? "";
                        $allReports->potassium = $data['Potassium'] ?? "";
                        $allReports->chloride = $data['Chloride'] ?? "";
                        $allReports->bun_creatinine_ratio = $data['BUN/Creatinine Ratio'] ?? "";
                        $allReports->protein = $data['Protein, Total'] ?? "";
                        $allReports->albumin = $data['Albumin'] ?? "";
                        $allReports->globulin = $data['Globulin'] ?? "";
                        $allReports->albumin_globulin_ratio = $data['Albumin/Globulin Ratio'] ?? "";
                        $allReports->alp = $data['ALP (Alkaline Phosphatase)'] ?? "";
                        $allReports->alt = $data['ALT (Alanine Amino Transferase)'] ?? "";
                        $allReports->ast = $data['AST (Aspartate Amino Transferase)'] ?? "";
                        $allReports->egfr_african_descent = $data['eGFR, African descent'] ?? "";
                        $allReports->bilirubin = $data['Bilirubin, Total'] ?? "";
                        $allReports->egfr_non_african_descent = $data['eGFR, Non-African descent'] ?? "";
                        $allReports->dhea_s = $data['DHEA-S'] ?? "";
                        $allReports->thyroid_stimulating_hormone = $data['Thyroid Stimulating Hormone 3'] ?? "";
                        $allReports->thyroxine = $data['Thyroxine (T4), Free'] ?? "";
                        $allReports->thyroid_peroxidase_ab = $data['Thyroid Peroxidase Ab'] ?? "";
                        $allReports->wbc = $data['WBC'] ?? "";
                        $allReports->rbc = $data['RBC'] ?? "";
                        $allReports->hemoglobin = $data['Hemoglobin'] ?? "";
                        $allReports->hematocrit = $data['Hematocrit'] ?? "";
                        $allReports->mcv = $data['MCV'] ?? "";
                        $allReports->mch = $data['MCH'] ?? "";
                        $allReports->mchc = $data['MCHC'] ?? "";
                        $allReports->rcdw = $data['Red Cell Distribution Width'] ?? "";
                        $allReports->platelet_count = $data['Platelet Count'] ?? "";
                        $allReports->mean_platelet_volume = $data['Mean Platelet Volume'] ?? "";
                        $allReports->neutrophil = $data['Neutrophil %'] ?? "";
                        $allReports->neutrophil_absolute = $data['Neutrophil Absolute'] ?? "";
                        $allReports->lymphocyte = $data['Lymphocyte %'] ?? "";
                        $allReports->lymphocyte_absolute = $data['Lymphocyte Absolute'] ?? "";
                        $allReports->monocyte = $data['Monocyte %'] ?? "";
                        $allReports->monocyte_absolute = $data['Monocyte Absolute'] ?? "";
                        $allReports->eosinophil = $data['Eosinophil %'] ?? "";
                        $allReports->eosinophil_absolute = $data['Eosinophil Absolute'] ?? "";
                        $allReports->basophil = $data['Basophil %'] ?? "";
                        $allReports->basophil_absolute = $data['Basophil Absolute'] ?? "";
                        $allReports->glucose = $data['Glucose'] ?? "";
                        } elseif ($request->report_type === "combine_report") {
                            $allReports = new Allreport($request->all());
                            $patient = Patient::find($patientId);
                            if ($patient) {
                                $patientId = $patient->id;
                                $initialReport = Allreport::where('patient_id', $patientId)
                                                                       ->where('followup', 'Initial')
                                                                       ->first(); // Retrieve the initial report
                                if($initialReport) {
                                    $totalcount = Allreport::where('patient_id', $patientId)
                                                                          ->where('followup', 'like', 'followup-%')
                                                                          ->count();
                                    $count = $totalcount + 1;
									$followup = "followup-".$count;
                                    $allReports->followup =  $followup;
                                } else {
                                    $followup = "Initial";
                                    $allReports->followup =  $followup;
                                }
                            } else {
                                echo "patient not found";
                            }
						$allReports->user_id = Auth::id();
						$allReports->name = $patient_name;
						$allReports->first_name = $first_name;
						$allReports->last_name = $last_name;
				// 		$allReports->provider_name = $provider_name;
                        $allReports->cac = $data['cac'];
                        $allReports->right_hand_est_grip_strength = $data['Right Hand Est Grip Strength'];
                        $allReports->fev_1 = $data['Fev 1'];
                        $allReports->chol = $data['Cholesterol, Total'];
                        $allReports->hdl = $data['HDL Cholesterol'];
                        $allReports->cac_riskscore = $data['CAC Risk Score'] ?? "";
                        $allReports->nocac_riskscore = $data['Non CAC Risk Score'] ?? "";
                       /** $allReports->biological_age = $biologicalage ?? "";**/
                         /**$allReports->chances_of_dying = $chanceofdying ?? "";**/

						$phenotypic_age_demo = $allReports->phenotypic_age();
						$allReports->biological_age = $phenotypic_age_demo['biological_age'];
						$allReports->chances_of_dying = $phenotypic_age_demo['chances_of_dying'];

						// for fetch bioage and labage
						$lab_age_report = $allReports->lab_age_report();
						$allReports->lab_age = $lab_age_report['lab_age'];


						$heart_age_report = $allReports->heart_age_report();
						$allReports->heart_age = $heart_age_report['heart_age'];

						// for fetchbio_age report
						$balance_age_report = $allReports->balance_age_report();
						$allReports->balance_age = $balance_age_report['balance_age'];
						// dd($record->balance_age);
						$grip_strength = $allReports->grip_strength();
						$allReports->equivalent_age_for_grip_strength = $grip_strength['equivalent_age_for_grip_strength'];
						// dd($record->equivalent_age_for_grip_strength);

						$musculoskeletal_age_report = $allReports->musculoskeletal_age_report();
						$allReports->musculoskeletal_age = $musculoskeletal_age_report['musculoskeletal_age'];

						$brain_age_report = $allReports->brain_age_report();
						$allReports->brain_age = $brain_age_report['brain_age'];
						// dd($record->brain_age);
						$bio_age_report = $allReports->bio_age_report();
						$allReports->bio_age = $bio_age_report['bio_age'];

						$risk_score = $allReports->risk_score();

                        $allReports->albumin_liver = $data['Albumin'] ?? "";
                        $allReports->alp_liver = $data['ALP (Alkaline Phosphatase)'] ?? "";
                        $allReports->creatinine_kidney = $data['Creatinine'] ?? "";
                        $allReports->crp_immune = $data['CRP Immune'] ?? "";
                        $allReports->lympho_immune = $data['Lympho Immune'] ?? "";
                        $allReports->mcv_bone_marrow = $data['Mcv Bone Marrow'] ?? "";
                        $allReports->rdw_bone_marrow = $data['rdw'] ?? "";
                        $allReports->pwv = $data['pmv'] ?? "";
                        $allReports->imt = $data['imt'] ?? "";
                        $allReports->pr_interval = $data['PR Interval'] ?? "";
                        $allReports->hr_bp_average = $data['Hr bp average'] ?? "";
                        $allReports->hr_bp_average_dbp = $data['Hr bp average dbp'] ?? "";
                        $allReports->skin_age = $data['skin_age'] ?? "";
                        $allReports->left_breast_thermography = $data['Left Breast Thermography'] ?? "";
                        $allReports->right_breast_thermography = $data['Right Breast Thermography'] ?? "";
                        $allReports->tanita_metabolic_age =$data['Tanita Metabolic Age'] ?? "";
                        $allReports->bf_percent = $data['Bf Percent'] ?? "";
                        $allReports->vo_2_max = $data['Vo2max'] ?? "";
                        $allReports->trudiagnostic_truage =$data['Trudiagnostic Truage'] ?? "";
                        $allReports->sleep_ahi = $data['Sleep Ahi'] ?? "";
                        $allReports->hrv = $data['hrv'] ?? "";
                            // lab report
                        //$allReports->followup = $followup;
                        $allReports->hs_crp = $data['hs-CRP'] ?? "";
				        $allReports->oxldl = $data['OxLDL'] ?? "";
				        $allReports->estimated_average_glucose = $data['Estimated Average Glucose'] ?? "";
				        $allReports->hba1c = $data['HbA1c'] ?? "";
				        $allReports->homocysteine = $data['Homocysteine'] ?? "";
				        $allReports->egfr = $data['eGFR'] ?? "";
				        $allReports->testosterone = $data['Testosterone'] ?? "";
				        $allReports->testosterone_free = $data['Testosterone, Free'] ?? "";
				        $allReports->testosterone_free_pt = $data['Testosterone, % Free'] ?? "";
				        $allReports->shbg = $data['Sex Hormone Binding Globulin'] ?? "";
				        $allReports->ferritin = $data['Ferritin'] ?? "";
				        $allReports->prostatic_specific_ag	 = $data['Prostatic Specific Ag, Total'] ?? "";
				// 		$allReports->provider_name = $provider_name;
                        $allReports->cholesterol_total = $data['Cholesterol, Total'] ?? "";
                        $allReports->hdl_cholesterol = $data['HDL Cholesterol'] ?? "";
                        $allReports->triglycerides = $data['Triglycerides'] ?? "";
                        $allReports->ldl_cholesterol_calculated = $data['LDL Cholesterol, Calculated'] ?? "";
                        $allReports->chol_hdl_c = $data['Chol/HDL-C'] ?? "";
                        $allReports->non_hdl_cholesterol = $data['Non-HDL Cholesterol'] ?? "";
                        $allReports->tg_hdl_c = $data['TG/HDL-C'] ?? "";
                        $allReports->ldl_p = $data['LDL-P(4)'] ?? "";
                        $allReports->small_ldl_p = $data['Small LDL-P'] ?? "";
                        $allReports->ldl_size = $data['LDL Size'] ?? "";
                        $allReports->hdl_p = $data['HDL-P'] ?? "";
                        $allReports->large_hdl_p = $data['Large HDL-P'] ?? "";
                        $allReports->hdl_size = $data['HDL Size'] ?? "";
                        $allReports->vldl_size = $data['VLDL Size'] ?? "";
                        $allReports->large_vldl_p = $data['Large VLDL-P'] ?? "";
                        $allReports->vitamin_d = $data['Vitamin D, 25-Hydroxy by LC-MS'] ?? "";
                        $allReports->omegacheck = $data['Whole Blood: EPA DPA DHA'] ?? "";
                        $allReports->arachidonic_acid_epa_ratio = $data['Arachidonic Acid/EPA Ratio'] ?? "";
                        $allReports->omega6_omega3_ratio = $data['Omega-6/Omega-3 Ratio'] ?? "";
                        $allReports->omega3_total = $data['Omega-3 total'] ?? "";
                        $allReports->epa = $data['EPA'] ?? "";
                        $allReports->dpa = $data['DPA'] ?? "";
                        $allReports->dha = $data['DHA'] ?? "";
                        $allReports->omega6_total = $data['Omega-6 total'] ?? "";
                        $allReports->arachidonic_acid = $data['Arachidonic Acid'] ?? "";
                        $allReports->linoleic_acid = $data['Linoleic Acid'] ?? "";
                        $allReports->co2 = $data['Bicarbonate'] ?? "";
                        $allReports->bun = $data['Blood-Urea-Nitrogen'] ?? "";
                        $allReports->creatinine = $data['Creatinine'] ?? "";
                        $allReports->calcium = $data['Calcium-Total'] ?? "";
                        $allReports->sodium = $data['Sodium'] ?? "";
                        $allReports->potassium = $data['Potassium'] ?? "";
                        $allReports->chloride = $data['Chloride'] ?? "";
                        $allReports->bun_creatinine_ratio = $data['BUN/Creatinine Ratio'] ?? "";
                        $allReports->protein = $data['Protein, Total'] ?? "";
                        $allReports->albumin = $data['Albumin'] ?? "";
                        $allReports->globulin = $data['Globulin'] ?? "";
                        $allReports->albumin_globulin_ratio = $data['Albumin/Globulin Ratio'] ?? "";
                        $allReports->alp = $data['ALP (Alkaline Phosphatase)'] ?? "";
                        $allReports->alt = $data['ALT (Alanine Amino Transferase)'] ?? "";
                        $allReports->ast = $data['AST (Aspartate Amino Transferase)'] ?? "";
                        $allReports->egfr_african_descent = $data['eGFR, African descent'] ?? "";
                        $allReports->bilirubin = $data['Bilirubin, Total'] ?? "";
                        $allReports->egfr_non_african_descent = $data['eGFR, Non-African descent'] ?? "";
                        $allReports->dhea_s = $data['DHEA-S'] ?? "";
                        $allReports->thyroid_stimulating_hormone = $data['Thyroid Stimulating Hormone 3'] ?? "";
                        $allReports->thyroxine = $data['Thyroxine (T4), Free'] ?? "";
                        $allReports->thyroid_peroxidase_ab = $data['Thyroid Peroxidase Ab'] ?? "";
                        $allReports->wbc = $data['WBC'] ?? "";
                        $allReports->rbc = $data['RBC'] ?? "";
                        $allReports->hemoglobin = $data['Hemoglobin'] ?? "";
                        $allReports->hematocrit = $data['Hematocrit'] ?? "";
                        $allReports->mcv = $data['MCV'] ?? "";
                        $allReports->mch = $data['MCH'] ?? "";
                        $allReports->mchc = $data['MCHC'] ?? "";
                        $allReports->rcdw = $data['Red Cell Distribution Width'] ?? "";
                        $allReports->platelet_count = $data['Platelet Count'] ?? "";
                        $allReports->mean_platelet_volume = $data['Mean Platelet Volume'] ?? "";
                        $allReports->neutrophil = $data['Neutrophil %'] ?? "";
                        $allReports->neutrophil_absolute = $data['Neutrophil Absolute'] ?? "";
                        $allReports->lymphocyte = $data['Lymphocyte %'] ?? "";
                        $allReports->lymphocyte_absolute = $data['Lymphocyte Absolute'] ?? "";
                        $allReports->monocyte = $data['Monocyte %'] ?? "";
                        $allReports->monocyte_absolute = $data['Monocyte Absolute'] ?? "";
                        $allReports->eosinophil = $data['Eosinophil %'] ?? "";
                        $allReports->eosinophil_absolute = $data['Eosinophil Absolute'] ?? "";
                        $allReports->basophil = $data['Basophil %'] ?? "";
                        $allReports->basophil_absolute = $data['Basophil Absolute'] ?? "";
                        $allReports->glucose = $data['Glucose'] ?? "";
                        }
                        $allReports->patient_id = $patientId;
						$allReports->user_id = Auth::id();
                        $allReports->name = $patient_name;
                        $allReports->first_name = $firstName;
                        $allReports->last_name = $lastName;
                        $allReports->report_type = $request->report_type;
                        $allReports->save();
                    }
                }
            }
        }
        return redirect("/reports")->with(
            "success",
            "Report has been created."
        );
    }

    public function report_store(Request $request)
    {
        // dd("hello");
        $firstName = $request->first_name;
        $lastName = $request->last_name;
        $existingPatient = Patient::where("first_name", $firstName)
            ->where("last_name", $lastName)
            ->first();
        if ($existingPatient) {
            $patientId = $existingPatient->id;
        } else {
            $newPatient = new Patient();
            $newPatient->first_name = $firstName;
            $newPatient->last_name = $lastName;
            $today = date("Y-m-d");
            $diff = date_diff(
                date_create($request->birthday),
                date_create($today)
            );
            $age = $diff->format("%y");
            $newPatient->age = $age;
            $newPatient->save();
            $patientId = $newPatient->id;
        }

        $allReports = new Report();
        $today = date("Y-m-d");
        $diff = date_diff(date_create($request->birthday), date_create($today));
        $age = $diff->format("%y");
        $allReports->patient_id = $patientId;
        $allReports->name = $firstName . " " . $lastName; // Merge first name and last name
        $allReports->first_name = $firstName;
        $allReports->last_name = $lastName;
        $allReports->age = $age;
        $allReports->height = $request->height;
        $allReports->height_unit = $request->height_unit;
        $allReports->weight = $request->weight;
        $allReports->weight_unit = $request->weight_unit;
        $allReports->birthday = $request->birthday;
        $allReports->ethnicity = $request->ethnicity;
        $allReports->diabetes = $request->diabetes;
        $allReports->smoke = $request->smoke;
        $allReports->fhhx = $request->fhhx;
        $allReports->lipid = $request->lipid;
        $allReports->htnmed = $request->htnmed;
        $allReports->report_type = "bioage_report"; // You can change this if needed

        $phenotypic_age_demo = $allReports->phenotypic_age();
		$allReports->biological_age = $phenotypic_age_demo['biological_age'];
		$allReports->chances_of_dying = $phenotypic_age_demo['chances_of_dying'];

		// for fetch bioage and labage
		$lab_age_report = $allReports->lab_age_report();
		$allReports->lab_age = $lab_age_report['lab_age'];
        // dd($allReports->lab_age);

		$heart_age_report = $allReports->heart_age_report();
		$allReports->heart_age = $heart_age_report['heart_age'];

		// for fetchbio_age report
		$balance_age_report = $allReports->balance_age_report();
		$allReports->balance_age = $balance_age_report['balance_age'];
		// dd($record->balance_age);

		$grip_strength = $allReports->grip_strength();
		$allReports->equivalent_age_for_grip_strength = $grip_strength['equivalent_age_for_grip_strength'];
		// dd($record->equivalent_age_for_grip_strength);

		$musculoskeletal_age_report = $allReports->musculoskeletal_age_report();
		$allReports->musculoskeletal_age = $musculoskeletal_age_report['musculoskeletal_age'];

		$brain_age_report = $allReports->brain_age_report();
		$allReports->brain_age = $brain_age_report['brain_age'];
		// dd($record->brain_age);
		$bio_age_report = $allReports->bio_age_report();
		$allReports->bio_age = $bio_age_report['bio_age'];
        dd($allReports->bio_age);
		$risk_score = $allReports->risk_score();
        $allReports->save();
        return redirect("/reports")->with([
            "success" => "Report has been created.",
        ]);
    }

    private function extractDataFromPDF($pdfFilePath)
    {
        $parser = new Parser();
        $pdf = $parser->parseFile($pdfFilePath);
        $text = $pdf->getText();
        //dd($text);
        $patterns = array(
            // 'Patient Name' => '/Report Status\s*:\s*Final\s*([\w\s,]+)\s*(?:\n|$)/',
            'Patient Name' => '/Report Status\s*:\s*Final\s*([^\\n]+)/',
            //'DOB' => '/\b(\d{2}\/\d{2}\/\d{4})\b/',
            'Gender' => '/\b(Male|Female)\b/',
            'Phone' => '/\b(\d{3}-\d{3}-\d{4})\b/',
            'Age' => '/\b(\d{2,3})\b/',
            'Cholesterol, Total' => '/Cholesterol, Total\s+(\d+)\s+<\d+\s+N\/A\s+≥\d+/',
            'HDL Cholesterol' => '/HDL Cholesterol\s+(\d+)\s+≥\d+\s+N\/A\s+<\d+/',
            'Triglycerides' => '/Triglycerides\s+(\d+)\s+<\d+\s+\d+-\d+\s+≥\d+/',
            'LDL Cholesterol, Calculated' => '/LDL Cholesterol, Calculated\s+(\d+)/',
            'Chol/HDL-C' => '/Chol\/HDL-C\s+(\d+(\.\d+)?)\s+≤\d+(\.\d+)?\s+\d+(\.\d+)?-\d+(\.\d+)?\s+>\d+(\.\d+)?\s+calc/',
            'Non-HDL Cholesterol' => '/Non-HDL Cholesterol\s+(\d+)\s+<(\d+)\s+(\d+)-(\d+)\s+≥(\d+)\s+mg\/dL \(calc\)/',
            'TG/HDL-C' => '/TG\/HDL-C\s+(\d+(\.\d+)?)\s+<\d+(\.\d+)?\s+\d+(\.\d+)?-\d+(\.\d+)?\s+>\d+(\.\d+)?\s+calc/',
            'LDL-P(4)' => '/LDL-P\s+\(4\)\s+(\d+)\s+<(\d+)\s+(\d+)-(\d+)\s+>(\d+)\s+nmol\/L/',
            'Small LDL-P' => '/Small LDL-P\s+(\d+)\s+<(\d+)\s+(\d+)-(\d+)\s+>(\d+)\s+nmol\/L/',
            'LDL Size' => '/LDL Size\s+(\d+(\.\d+)?)\s+>\d+(\.\d+)\s+N\/A\s+≤\d+(\.\d+)\s+nm/',
            'HDL-P' => '/HDL-P\s+(\d+(\.\d+)?)\s+>(\d+(\.\d+)?)\s+(\d+(\.\d+)?)-(\d+(\.\d+)?)\s+<(\d+(\.\d+)?)\s+umol\/L/',
            'Large HDL-P' => '/Large HDL-P\s+(\d+(\.\d+)?)\s+>(\d+(\.\d+)?)\s+(\d+(\.\d+)?)-(\d+(\.\d+)?)\s+<(\d+(\.\d+)?)\s+umol\/L/',
            'HDL Size' => '/HDL Size\s+(\d+(\.\d+)?)\s+>(\d+(\.\d+)?)\s+(\d+(\.\d+)?)-(\d+(\.\d+)?)\s+<(\d+(\.\d+)?)\s+nm/',
            'Large VLDL-P' => '/Large VLDL-P\s+<(\d+(\.\d+)?)\s+<(\d+(\.\d+)?)\s+(\d+(\.\d+)?)-(\d+(\.\d+)?)\s+>(\d+(\.\d+)?)\s+nmol\/L/',
            // 'VLDL Size' => '/VLDL Size\s+(\d+(\.\d+)?)\s+<(\d+(\.\d+)?)\s+(\d+(\.\d+)?)\s+>\d+(\.\d+)?\s+nm/',
            'Glucose' => '/Glucose\s+(\d+)\s+\\d+-\d+\s+\d+-\d+<\d+\s+OR\s+≥(\d+)\s+mg\/dL/',
            // 'Vitamin D, 25-Hydroxy by LC-MS/MS(2)' => '/Vitamin\s+D,\s+25-Hydroxy\s+by\s+LC-MS\/MS\(2\)\s+\n\n([\d.]+)/',
            'OmegaCheck' => '/OmegaCheck®\s+\(Whole Blood: EPA\+DPA\+DHA\)\((\d+)\)/',
            'Arachidonic Acid/EPA Ratio' => '/Arachidonic Acid\/EPA Ratio\s+(\d+\.\d+)\s+H?/',
            'Omega-6/Omega-3 Ratio' => '/Omega-6\/Omega-3 Ratio\s+(\d+\.\d+)/',
            'Omega-3 total' => '/Omega-3 total\s+(\d+\.\d+)/',
            'EPA' => '/EPA\s+(\d+\.\d+)/',
            'DPA' => '/DPA\s+(\d+\.\d+)/',
            'DHA' => '/DHA\s+(\d+\.\d+)/',
            // 'Omega-6 total' => '/Omega-6\/Omega-3 Ratio\s+(\d+\.\d+)/',
            'Arachidonic Acid' => '/Arachidonic Acid\s+(\d+\.\d+)/',
            'Linoleic Acid' => '/Linoleic Acid\s+(\d+\.\d+)/',
            'Glucose-Routine' => '/Comprehensive Metabolic Panel.*\n.*Glucose\s+(\d+)/',
            'Calcium-Total' => '/Calcium, Total\s+(\d+\.\d+)/',
            'Sodium' => '/Sodium\s+(\d+)/',
            'Potassium' => '/Potassium\s+(\d+(\.\d+)?)/',
            'Chloride' => '/Chloride\s+(\d+(\.\d+)?)/',
            'Bicarbonate' => '/Bicarbonate\)\s+(\d+(\.\d+)?)/',
            'Blood-Urea-Nitrogen' => '/BUN \(Blood Urea Nitrogen\)\s+(\d+(\.\d+)?)/',
            'Creatinine' => '/Creatinine\s+(\d+(\.\d+)?)/',
            // 'BUN/Creatinine Ratio' => '/BUN\/Creatinine Ratio\s+(\d+(\.\d+)?)/',
            'BUN/Creatinine Ratio' => '/BUN\/Creatinine Ratio\s+([\d.]+|Not Applicable)/',
            'Protein, Total' => '/Protein, Total\s+(\d+(\.\d+)?)/',
            'Albumin' => '/Albumin\s+(\d+(\.\d+)?)/',
            'Globulin' => '/Globulin\s+(\d+(\.\d+)?)/',
            'Albumin/Globulin Ratio' => '/Albumin\/Globulin Ratio\s+(\d+(\.\d+)?)/',
            'ALP (Alkaline Phosphatase)' => '/ALP \(Alkaline Phosphatase\)\s+(\d+(\.\d+)?)/',
            'ALT (Alanine Amino Transferase)' => '/ALT \(Alanine Amino Transferase\)\s+(\d+(\.\d+)?)/',
            // 'AST (Aspartate Amino Transferase)' => '/AST \(Aspartate Amino Transferase\)\s+(\d+(\.\d+)?)/',
            'Bilirubin, Total' => '/Bilirubin, Total\s+(\d+(\.\d+)?)/',
            'eGFR, Non-African descent' => '/eGFR, Non-African descent\s+(\d+(\.\d+)?)/',
            'eGFR, African descent' => '/eGFR, African descent\s+(\d+(\.\d+)?)/',
            'TSH' => '/TSH\)\((\d+(\.\d+)?)/',
            'Thyroxine (T4), Free' => '/Thyroxine \(T4\), Free\s+(\d+(\.\d+)?)/',
            'Thyroid Peroxidase Ab' => '/Thyroid Peroxidase Ab\s+(\d+(\.\d+)?)/',
            'WBC' => '/WBC\s+(\d+(\.\d+)?)/',
            'RBC' => '/RBC\s+(\d+(\.\d+)?)/',
            'Hemoglobin' => '/Hemoglobin\s+(\d+(\.\d+)?)/',
            'Hematocrit' => '/Hematocrit\s+(\d+(\.\d+)?)/',
            'MCV' => '/MCV\s+(\d+(\.\d+)?)/',
            'MCH' => '/MCH\s+(\d+(\.\d+)?)/',
            'MCHC' => '/MCHC\s+(\d+(\.\d+)?)/',
            'Red Cell Distribution Width' => '/Red Cell Distribution Width\s+(\d+(\.\d+)?)/',
            'Platelet Count' => '/Platelet Count\s+(\d+(\.\d+)?)/',
            'Mean Platelet Volume' => '/Mean Platelet Volume\s+(\d+(\.\d+)?)/',
            'Neutrophil %' => '/Neutrophil %\s+(\d+(\.\d+)?)/',
            'Neutrophil Absolute' => '/Neutrophil Absolute\s+(\d+(\.\d+)?)/',
            'Lymphocyte %' => '/Lymphocyte %\s+(\d+(\.\d+)?)/',
            'Lymphocyte Absolute' => '/Lymphocyte Absolute\s+(\d+(\.\d+)?)/',
            'Monocyte %' => '/Monocyte %\s+(\d+(\.\d+)?)/',
            'Monocyte Absolute' => '/Monocyte Absolute\s+(\d+(\.\d+)?)/',
            'Eosinophil %' => '/Eosinophil %\s+(\d+(\.\d+)?)/',
            'Eosinophil Absolute' => '/Eosinophil Absolute\s+(\d+(\.\d+)?)/',
            'Basophil %' => '/Basophil %\s+(\d+(\.\d+)?)/',
            'Basophil Absolute' => '/Basophil Absolute\s+(\d+(\.\d+)?)/',
            'hs-CRP' => '/hs-CRP\s+(\d+(\.\d+)?)/',
            'Homocysteine' => '/Homocysteine\s+(\d+(\.\d+)?)/',
            'Whole Blood: EPA DPA DHA' => '/\(Whole Blood: EPA\+DPA\+DHA\)\s*\(\d+\)\s*(\d+(\.\d+)?)/',
            'Omega-6 total' => '/Omega-6 total\s+(\d+(\.\d+)?)/',
            'Calcium, Total' => '/Calcium, Total\s+(\d+(\.\d+)?)/',
            'DHEA-S' => '/DHEA-S\s+(\d+(\.\d+)?)/',
            'TESTOSTERONE, TOTAL'=> '/TESTOSTERONE, TOTAL, MS\s+\((\d+)\).*\(AMD\)\s+(\d+)/',
            'TESTOSTERONE, FREE'=>'/TESTOSTERONE, FREE\s+\(AMD\)\s+(\d+(\.\d+)?)/',
            'TESTOSTERONE, BIOAVAILABLE' => '/TESTOSTERONE,\s*BIOAVAILABLE\s*\(AMD\)\s*(\d+(\.\d+)?)\s*/',
            'SEX HORMONE BINDING GLOB' => '/SEX\s+HORMONE\s+BINDING\s+GLOB\s*\(AMD\)\s*(\d+(\.\d+)?)\s*/',
            'ALBUMIN (AMD)' => '/ALBUMIN\s*\(AMD\)\s*(\d+(\.\d+)?)\s*/',
            'Thyroid Stimulating Hormone' => '/Thyroid Stimulating Hormone\s*\(TSH\)\s*\(2\)\s*(\d+(\.\d+)?)\s*/',
            'ANA SCREEN, IFA' => '/ANA SCREEN, IFA\s*\(AMD\)\s*(\w+)/',
            'Rheumatoid Factor' => '/Rheumatoid Factor\s*\(AMD\)\s*<(\d+(\.\d+)?)\s+IU\/mL\s+AMD/',
            'OxLDL' => '/OxLDL\s+(\d+(\.\d+)?)/',
            'HbA1c' => '/HbA1c\s+(\d+(\.\d+)?)/',
            'Estimated Average Glucose' => '/Estimated Average Glucose\s+(\d+(\.\d+)?)/',
            // 'AST (Aspartate Amino Transferase)' => '/AST \(Aspartate Amino Transferase\)\s+(\d+(\.\d+)?)\s+U\/L Z4M/',
            'eGFR' => '/eGFR\s+(\d+(\.\d+)?)/',
            'Testosterone' => '/Testosterone\s+(\d+(\.\d+)?)/',
            'Testosterone, Free' => '/Testosterone,\s*Free\s+(\d+(\.\d+)?)/',
            'Testosterone, % Free' => '/Testosterone,\s*%\s*Free\s+(\d+(\.\d+)?)/',
            'Sex Hormone Binding Globulin' => '/Sex\s+Hormone\s+Binding\s+Globulin\s+(\d+(\.\d+)?)/',
            // 'Thyroid Stimulating Hormone 3' => '/Thyroid Stimulating Hormone\s*\(TSH\)\s*\(3\)\s*(\d+(\.\d+)?)\s*/',
            'Ferritin' => '/Ferritin\s+(\d+(\.\d+)?)/',
            'Prostatic Specific Ag, Total' => '/Prostatic Specific Ag, Total\s+\(2\)\s+(\d+(\.\d+)?)/',

            // Bioage report
            'cac' => '/cac\s+(\d+)\s+<\d+\s+N\/A\s+≥\d+/',
            'Right Hand Est Grip Strength' => '/Right Hand Est Grip Strength\s+(\d+)\s+<\d+\s+N\/A\s+≥\d+/',
            'Fev 1' => '/Fev 1\s+(\d+)\s+<\d+\s+N\/A\s+≥\d+/',
            'Non CAC Risk Score' => '/Non CAC Risk Score\s+(\d+)\s+<\d+\s+N\/A\s+≥\d+/',
            'CAC Risk Score' => '/CAC Risk Score\s+(\d+)\s+<\d+\s+N\/A\s+≥\d+/',
            'CRP Immune' => '/CRP Immune\s+(\d+)\s+<\d+\s+N\/A\s+≥\d+/',
            'Lympho Immune' => '/Lympho Immune\s+(\d+)\s+<\d+\s+N\/A\s+≥\d+/',
            'Mcv Bone Marrow' => '/Mcv Bone Marrow\s+(\d+)\s+<\d+\s+N\/A\s+≥\d+/',
            'Rdw Bone Marrow' => '/Rdw Bone Marrow\s+(\d+)\s+<\d+\s+N\/A\s+≥\d+/',
            'pmv' => '/pmv\s+(\d+)\s+<\d+\s+N\/A\s+≥\d+/',
            'imt' => '/imt\s+(\d+)\s+<\d+\s+N\/A\s+≥\d+/',
            'PR Interval' => '/PR Interval\s+(\d+)\s+<\d+\s+N\/A\s+≥\d+/',
            'Hr bp average' => '/Hr bp average\s+(\d+)\s+<\d+\s+N\/A\s+≥\d+/',
            'Hr bp average dbp' => '/Hr bp average dbp\s+(\d+)\s+<\d+\s+N\/A\s+≥\d+/',
            'Skin Age' => '/Skin Age\s+(\d+)\s+<\d+\s+N\/A\s+≥\d+/',
            'Left Breast Thermography' => '/Left Breast Thermography\s+(\d+)\s+<\d+\s+N\/A\s+≥\d+/',
            'Right Breast Thermography' => '/Right Breast Thermography\s+(\d+)\s+<\d+\s+N\/A\s+≥\d+/',
            'Tanita Metabolic Age' => '/Tanita Metabolic Age\s+(\d+)\s+<\d+\s+N\/A\s+≥\d+/',
            'Bf Percent' => '/Bf Percent\s+(\d+)\s+<\d+\s+N\/A\s+≥\d+/',
            'Vo2max' => '/Vo2max\s+(\d+)\s+<\d+\s+N\/A\s+≥\d+/',
            'Trudiagnostic Truage' => '/Trudiagnostic Truage\s+(\d+)\s+<\d+\s+N\/A\s+≥\d+/',
            'Sleep Ahi' => '/Sleep Ahi\s+(\d+)\s+<\d+\s+N\/A\s+≥\d+/',
            'hrv' => '/hrv\s+(\d+)\s+<\d+\s+N\/A\s+≥\d+/',
        );




        $extractedData = array();
        foreach ($patterns as $testName => $pattern) {
            if (preg_match($pattern, $text, $matches)) {
                $extractedData[$testName] = $matches[1];
            }
			else
			{
				$extractedData[$testName] = "";
			}
        }

		preg_match('/\b(\d{2}\/\d{2}\/\d{4})\b/', $text, $matches);
        if (isset($matches[1])) {
            $result = $matches[1];
			$date = DateTime::createFromFormat('m/d/Y', $result);
			$formattedDate = $date->format('Y-m-d');
            $extractedData["DOB"] = $formattedDate;
        }

        preg_match('/\(2\)\s+([0-9.]+)/', $text, $matches);
        if (isset($matches[1])) {
            $result = $matches[1];
            $extractedData["Vitamin D, 25-Hydroxy by LC-MS"] = $result;
        }

        preg_match('/FATTY ACIDS.+?\(3\)\s+([0-9.]+)/s', $text, $matches);
        if (isset($matches[1])) {
            $result = $matches[1];
            $extractedData["Whole Blood: EPA DPA DHA"] = $result;
        }

        preg_match('/VLDL Size\s+([\d.]+)/', $text, $matches);
        if (isset($matches[1])) {
            $result = $matches[1];
            $extractedData["VLDL Size"] = $result;
        }

        preg_match('/AST\s*\(?\s*Aspartate\s*Amino\s*Transferase\s*\)?\s*\n\s*(\d+)/i', $text, $matches);
        if (isset($matches[1])) {
            $result = $matches[1];
            $extractedData["AST (Aspartate Amino Transferase)"] = $result;
        }

        preg_match('/Thyroid\s*Stimulating\s*Hormone\s*\(TSH\)\(\d\)\s*(\d+\.\d+)\s*(\w+)/', $text, $matches);
        if (isset($matches[1])) {
            $result = $matches[1] . ' ' . $matches[2];
            $extractedData["Thyroid Stimulating Hormone (TSH)"] = $result;
        }

        return $extractedData;
    }

    public function editLabReport(Request $request)
    {
        $id = $request->input("id");
        $timestamp = $request->input("date");
        $date = Carbon::createFromTimestamp($timestamp / 1000);
        $formattedDate = $date->format("Y-m-d H:i:s");
        $record = Cardiometabolicreport::find($id);
        if ($record) {
            $name = $record->name;
            $name = trim($name);
            $nameParts = explode(" ", $name);
            $firstName = $nameParts[0];
            $lastName = $nameParts[1];
            $patients = Patient::where("first_name", $firstName)
                ->where("last_name", $lastName)
                ->first();
            $allReportss = Cardiometabolicreport::with("patient")
                ->where("id", $id)
                ->first();
            return view("edit_lab_report", compact("reports", "patients"));
        }
    }

    // Update Lab Report
    public function updateLabReport(Request $request)
    {
        $input = $request->input();
        $id = $request->id;
        $record = Cardiometabolicreport::find($id);
        if ($record) {
            $first_name = $record->first_name;
            $last_name = $record->last_name;
            $patients = Patient::where("first_name", $first_name)
                ->where("last_name", $last_name)
                ->first();
            $name = $request->name;
            if ($patients === null) {
                $patients = new \App\Models\Patient();
            }
            $patients->first_name = $request->first_name;
            $patients->last_name = $request->last_name;
            $patients->phone = $request->phone;
            $patients->email = $request->email;
            $patients->address_line_1 = $request->address_line_1;
            $patients->address_line_2 = $request->address_line_2;
            $patients->city = $request->city;
            $patients->province = $request->province;
            $patients->country = $request->country;
            $patients->zip = $request->zip;
            $patients->gender = $request->gender;
            $today = date("Y-m-d");
            $diff = date_diff(
                date_create($request->birthday),
                date_create($today)
            );
            $age = $diff->format("%y");
            $patients->age = $age;
            $patients->height = $request->height;
            $patients->height_unit = $request->height_unit;
            $patients->weight = $request->weight;
            $patients->weight_unit = $request->weight_unit;
            $patients->birthday = $request->birthday;
            $patients->ethnicity = $request->ethnicity;
            $patients->diabetes = $request->diabetes;
            $patients->smoke = $request->smoke;
            $patients->fhhx = $request->fhhx;
            $patients->lipid = $request->lipid;
            $patients->htnmed = $request->htnmed;
            $patients->deprecated = $request->deprecated;
            $patients->save();
        }

        $record->fill($input);
        $record->status = "Active";
        $patients->editable_fname = $request->editable_fname;
        $patients->editable_lname = $request->editable_lname;
        $hs_crp_calculate = $record->hs_crp_calculate();
        $record->hs_crp_calculate = $hs_crp_calculate["hs_crp_calculate"];
        $record->save();
        $data = [
            "status" => "Success",
            "id" => $record->id,
        ];
        return redirect("/reports")->with(
            "success",
            "Report has been updated."
        );
    }

    // Show Lab Report
    public function showLabReport(Request $request)
    {
        $allReports = Cardiometabolicreport::with("patient")
            ->where("id", "=", $request->id)
            ->get();
        if (!$allReports) {
            return redirect()
                ->back()
                ->with("error", "Report not found.");
        }
        return view("show_lab_report", compact("reports"));
    }

    // Edit Bioage Report
    public function editBioageReport(Request $request)
    {
        $id = $request->input("id");
        $timestamp = $request->input("date");
        $date = Carbon::createFromTimestamp($timestamp / 1000);
        $formattedDate = $date->format("Y-m-d H:i:s");

        $record = Report::find($id);

        if ($record) {
            $name = $record->name;
            $name = trim($name);
            $nameParts = explode(" ", $name);
            $firstName = $nameParts[0];
            $lastName = $nameParts[1];
            $patients = Patient::where("first_name", $firstName)
                ->where("last_name", $lastName)
                ->first();
            $allReports = Report::with("patient")
                ->where("id", $id)
                ->get();
            return view("edit_bioage_report", compact("reports", "patients"));
        }
    }

    // Update Lab Report
    public function updateBioageReport(Request $request)
    {
        $input = $request->input();
        $id = $request->id;
        $record = Report::find($id);
        if ($record) {
            $first_name = $record->first_name;
            $last_name = $record->last_name;
            $patients = Patient::where("first_name", $first_name)
                ->where("last_name", $last_name)
                ->first();
            $name = $request->name;
            if ($patients === null) {
                $patients = new \App\Models\Patient();
            }
            $patients->first_name = $request->first_name;
            $patients->last_name = $request->last_name;
            $patients->phone = $request->phone;
            $patients->email = $request->email;
            $patients->address_line_1 = $request->address_line_1;
            $patients->address_line_2 = $request->address_line_2;
            $patients->city = $request->city;
            $patients->province = $request->province;
            $patients->country = $request->country;
            $patients->zip = $request->zip;
            $patients->gender = $request->gender;
            $today = date("Y-m-d");
            $diff = date_diff(
                date_create($request->birthday),
                date_create($today)
            );
            $age = $diff->format("%y");
            $patients->age = $age;
            $patients->height = $request->height;
            $patients->height_unit = $request->height_unit;
            $patients->weight = $request->weight;
            $patients->weight_unit = $request->weight_unit;
            $patients->birthday = $request->birthday;
            $patients->ethnicity = $request->ethnicity;
            $patients->diabetes = $request->diabetes;
            $patients->smoke = $request->smoke;
            $patients->fhhx = $request->fhhx;
            $patients->lipid = $request->lipid;
            $patients->htnmed = $request->htnmed;
            $patients->deprecated = $request->deprecated;
            $patients->save();
        }

        $record->fill($input);
        $record->status = "Active";
        $patients->editable_fname = $request->editable_fname;
        $patients->editable_lname = $request->editable_lname;
        $record->save();
        Session::flash("success", "Bioage Report has been updated.");
        $data = [
            "status" => "Success",
            "id" => $record->id,
        ];

        return redirect("/reports")->with("data", $data);
    }

    // Delete Bioage Report
    public function deleteBioageReport(Request $request)
    {
        $allReports = Report::find($request->id);
        $allReports->delete();
        return response()->json(["status" => "Success"]);
    }

    // Delete Lab Report
    public function deleteLabReport(Request $request)
    {
        $allReports = Cardiometabolicreport::find($request->id);
        $allReports->delete();
        return response()->json(["status" => "Success"]);
    }

    // Show Bioage Report
    public function showBioageReport(Request $request)
    {
        $allReports = Report::with("patient")
            ->where("id", "=", $request->id)
            ->get();
        if (!$allReports) {
            return redirect()
                ->back()
                ->with("error", "Report not found.");
        }
        return view("show_bioage_report", compact("reports"));
    }

    public function downloadPDFlab(Request $request)
    {
        $cardiometabolicreport = Cardiometabolicreport::with("patient")
            ->where("id", "=", $request->id)
            ->get();
        if (!$cardiometabolicreport) {
            return redirect()
                ->back()
                ->with("error", "Cardiometabolic Report not found.");
        }
        return view(
            "cardiometabolicreports.cardiometabolicreport_pdf",
            compact("cardiometabolicreport")
        );
    }

    public function downloadPDFbioage(Request $request)
    {
        $allReportss = Report::with("patient")
            ->where("id", "=", $request->id)
            ->get();
        if (!$allReports) {
            return redirect()
                ->back()
                ->with("error", "Report not found.");
        }
        return view("report.pdf", compact("reports"));
    }

    public function deleteallReports(Request $request)
    {
        $firstName = $request->input("first_name");
        $lastName = $request->input("last_name");
		$patientid = $request->input("patient_id");
        try {
            Cardiometabolicreport::where("patient_id", $patientid)
                ->delete();

            Report::where("patient_id", $patientid)
                ->delete();
            return response()->json(["status" => "Success"], 200);
        } catch (\Exception $e) {
            return response()->json(
                ["status" => "Error", "message" => $e->getMessage()],
                500
            );
        }
    }
}
