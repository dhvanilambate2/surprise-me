<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiteSettng;
use Illuminate\Support\Facades\Validator;

class SettingSiteController extends Controller
{
    
    public function index()
    {
        $sites = SiteSettng::find('1');
        if (!$sites) {
            // Handle the case where the HomeDetails is not found, for example, redirect to index with an error message
            return redirect()->route('setting_site.index')->with('error', 'Not Found');
        }

        // Load the associated media (brochures and images)
        $sites->loadMedia('header_logo');
        $sites->loadMedia('footer_logo');

        return view("backend.setting.site_setting.index", compact('sites'));
    }

    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'phone' => 'required|string',
            'time' => 'required|string',
            'address' => 'required|string|max:100',
            'facebook' => 'nullable|url',
            'skype' => 'nullable|url',
            'twitter' => 'nullable|url',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        // Find the site settings by ID
        $siteSetting = SiteSettng::findOrFail($id);

        // Assign values from the request to the model attributes
        $siteSetting->email = $request->input('email');
        $siteSetting->phone = $request->input('phone');
        $siteSetting->hours = $request->input('time');
        $siteSetting->address = $request->input('address');
        $siteSetting->facebook = $request->input('facebook');
        $siteSetting->skype = $request->input('skype');
        $siteSetting->twitter = $request->input('twitter');

        // Upload and store the header logo
        if ($request->hasFile('header_logo')) {
            $headerLogo = $request->file('header_logo');
            $siteSetting->addMedia($headerLogo)
                ->usingName('header_logo')
                ->toMediaCollection('header_logo');
        }

        // Upload and store the footer logo
        if ($request->hasFile('footer_logo')) {
            $footerLogo = $request->file('footer_logo');
            $siteSetting->addMedia($footerLogo)
                ->usingName('footer_logo')
                ->toMediaCollection('footer_logo');
        }
        
        // Upload and store the Loader Image
        if ($request->hasFile('loader_image')) {
            $loaderImage = $request->file('loader_image');
    
            // Remove old loader image data
            if ($siteSetting->hasMedia('loader_image')) {
                $siteSetting->getFirstMedia('loader_image')->delete();
            }
            
            $siteSetting->addMedia($loaderImage)
                ->usingName('loader_image')
                ->toMediaCollection('loader_image');
        }
        
        // Upload and store the Fevicon Image
        if ($request->hasFile('fev_image')) {
            $fevImage = $request->file('fev_image');
            if ($siteSetting->hasMedia('fev_image')) {
                $siteSetting->getFirstMedia('fev_image')->delete();
            }
            $siteSetting->addMedia($fevImage)
                ->usingName('fev_image')
                ->toMediaCollection('fev_image');
        }

        // Save the model to the database
        $siteSetting->save();

        // Redirect to the settings page or any other page you want
        return response()->json(['success' => true], 200);
        // return redirect()->route('setting_site.index')->with('success', 'Site settings have been updated successfully.');
    }
    

    

}
