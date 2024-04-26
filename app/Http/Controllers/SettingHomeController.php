<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\ClientReview;
use App\Models\HomeSections;
use Illuminate\Support\Facades\Validator;

class SettingHomeController extends Controller
{
    //
    public function index()
    {
        $reviews = ClientReview::all();
        $teams = Team::all();
        $teamSectionStatus = HomeSections::where('section_name', 'team_section')->first();
        $reviewSectionStatus = HomeSections::where('section_name', 'review_section')->first();
        return view('backend.setting.home.index',['teams' => $teams, 'reviews' => $reviews, 'team_section' => $teamSectionStatus, 'review_section' => $reviewSectionStatus ]);
    }

    // banner 
    public function bannerCreaet()
    {
        return view('backend.setting.home.banner_create');
    }

    // team
    public function teamCreaet()
    {
        return view('backend.setting.home.team_create');
    }
    public function teamStore(Request $request)
    {
        // Validate the form data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'post' => 'required|string|max:255',
            'description' => 'required|string',
            'facebook' => 'nullable|url',
            'skype' => 'nullable|url',
            'twitter' => 'nullable|url',
            'images' => '',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        // Create a new instance of your model
        $teamMember = new Team(); // Replace YourModel with the actual model you are using for the team

        // Assign values from the request to the model attributes
        $teamMember->name = $request->input('name');
        $teamMember->post = $request->input('post');
        $teamMember->description = $request->input('description');
        $teamMember->facebook = $request->input('facebook');
        $teamMember->skype = $request->input('skype');
        $teamMember->twitter = $request->input('twitter');

        // Upload and store the image
        if ($request->hasFile('images')) {
            $image = $request->file('images');
            $teamMember->addMedia($image)
                ->usingName($teamMember->name)
                ->toMediaCollection('teams');
        }
        
        // Save the model to the database
        $teamMember->save();
        return response()->json(['success' => true], 200);
    }
    public function teamDestroy(String $id)
    {
        $teams = Team::find($id);

        if (!$teams) {
            return redirect()->route('setting_home.index')->with('error', 'Not Found.');
        }

        // Delete associated media (brochures and images)
        $teams->clearMediaCollection('teams');

        // Delete the HomeDetails record
        $teams->delete();

        // Redirect or respond as needed
        return redirect()->route('setting_home.index')->with('success', 'The team member has been Deleted successfully.');
    }
    public function teamEdit(String $id)
    {
        $teams = Team::find($id);

        if (!$teams) {
            return redirect()->route('setting_home.index')->with('error', 'Not Found.');
        }

        // Load the associated media (brochures and images)
        $teams->loadMedia('temas');
        return view('backend.setting.home.team_edit', compact('teams'));
    }
    public function TeamUpdate(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'post' => 'required|string|max:255',
            'description' => 'required|string',
            'facebook' => 'nullable|url',
            'skype' => 'nullable|url',
            'twitter' => 'nullable|url',
            'images' => '',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $team = Team::find($id);
    
        // Update the team member with the new data
        $team->update([
            'name' => $request->input('name'),
            'post' => $request->input('post'),
            'description' => $request->input('description'),
            'facebook' => $request->input('facebook'),
            'skype' => $request->input('skype'),
            'twitter' => $request->input('twitter'),
        ]);
    
        // Update and store the new image
        if ($request->hasFile('images')) {
            // Delete existing media
            $team->clearMediaCollection('teams');
    
            $image = $request->file('images');
            $team->addMedia($image)
                ->usingName($team->name)
                ->toMediaCollection('teams');
        }
    
        // Redirect to the index page or any other page you want
        return response()->json(['success' => true], 200);
        // return redirect()->route('setting_home.index')->with('success', 'The team member has been Updated successfully.');
    }
    public function teamImgStore(Request $request)
    {
        $path = storage_path('tmp/uploads');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
    
        $file = $request->file('file');
    
        $name = uniqid() . '_' . trim($file->getClientOriginalName());
    
        // $file->move($path, $name);
    
        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }
    public function updateCurrentFour(Request $request)
    {
            $countCurrentFour = Team::where('current_four', '1')->count();
    
        
            $itemId = $request->input('id');
            $isCurrentFour = $request->input('is_current_project');   
            $team = Team::find($itemId);
            $massage = '';
            if($isCurrentFour == "true")
            {
                if($countCurrentFour >= 4)
                {
                      return response()->json(['error'=> true,'massage' => 'You\'ve reached the maximum limit of 3 current projects.']);  
                }
                else
                {
                    $team->current_four = '1';
                    $massage = 'This project has been added to the current project list.';
                }
            }
            else
            {
                $team->current_four = '0';
                $massage = 'This project has been removed from the current project list.';
            }
            $team->save();
       

        return response()->json(['success'=> true,'massage' => $massage]);

    }


    // client review 
    public function reviewCreaet()
    {
        return view('backend.setting.home.review_create');
    }
    public function reviewStore(Request $request)
    {
        
         $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'post' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        // Create a new instance of your model
        $reviewMember = new ClientReview(); // Replace YourModel with the actual model you are using for the team

        // Assign values from the request to the model attributes
        $reviewMember->name = $request->input('name');
        $reviewMember->post = $request->input('post');
        $reviewMember->description = $request->input('description');

        // Upload and store the image
        if ($request->hasFile('images')) {
            $image = $request->file('images');
            $reviewMember->addMedia($image)
                ->usingName($reviewMember->name)
                ->toMediaCollection('reviews');
        }
        
        // Save the model to the database
        $reviewMember->save();

        // Redirect to the index page or any other page you want
        return response()->json(['success' => true], 200);
    }
    public function reviewDestroy(String $id)
    {
        $reviews = ClientReview::find($id);

        if (!$reviews) {
            return redirect()->route('setting_home.index')->with('error', 'Not Found.');
        }

        // Delete associated media (brochures and images)
        $reviews->clearMediaCollection('reviews');

        // Delete the HomeDetails record
        $reviews->delete();

        // Redirect or respond as needed
        return redirect()->route('setting_home.index')->with('success', 'The client review has been Deleted successfully.');
    }
    public function reviewEdit(String $id)
    {
        $review = ClientReview::find($id);

        if (!$review) {
            return redirect()->route('setting_home.index')->with('error', 'Not Found.');
        }

        // Load the associated media (brochures and images)
        $review->loadMedia('review');
        return view('backend.setting.home.review_edit', compact('review'));
    }
    public function reviewUpdate(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'post' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        
        $review = ClientReview::find($id);
    
        // Update the team member with the new data
        $review->update([
            'name' => $request->input('name'),
            'post' => $request->input('post'),
            'description' => $request->input('description'),
        ]);
    
        // Update and store the new image
        if ($request->hasFile('images')) {
            // Delete existing media
            $review->clearMediaCollection('reviews');
    
            $image = $request->file('images');
            $review->addMedia($image)
                ->usingName($review->name)
                ->toMediaCollection('reviews');
        }
    
        // Redirect to the index page or any other page you want
        return response()->json(['success' => true], 200);
        // return redirect()->route('setting_home.index')->with('success', 'The client review has been Updated successfully.');
    }

}
