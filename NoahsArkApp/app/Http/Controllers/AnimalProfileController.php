<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AnimalProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnimalProfileController extends Controller
{
    /**
     * Show the form for creating a new animal profile.
     */
    public function create()
    {
        return view('admin.UploadingAnimalProfile');
    }

    /**
     * Store a newly created animal profile in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string|max:255',
            'name' => 'required|string|max:100',
            'age' => 'required|integer|min:0',
            'medical_records' => 'required|string|max:1000',
        ]);

        // Handle file upload
        $profilePicturePath = null;
        if ($request->hasFile('profile_picture')) {
            $profilePicturePath = $request->file('profile_picture')->store('animal_profiles', 'public');
        }

        // Create animal profile
        AnimalProfile::create([
            'profile_picture' => $profilePicturePath,
            'description' => $request->description,
            'name' => $request->name,
            'age' => $request->age,
            'medical_records' => $request->medical_records,
        ]);

        return redirect()->route('admin.uploading-animal-profile')->with('success', 'Animal profile uploaded successfully.');
    }

    /**
     * Display a listing of animal profiles.
     */
    public function list()
    {
        // Fetch all animal profiles
        $animalProfiles = AnimalProfile::where('is_adopted', false)->get();
        // Pass the profiles to the view
        return view('admin.AnimalProfileList', compact('animalProfiles'));
    }


    //
    public function deleteanimal($id){

        $animalProfiles = AnimalProfile::find($id);

        $animalProfiles->delete();

        return redirect()->back();
    }


    // update
    public function updateanimal($id){

        $animalProfiles = AnimalProfile::find($id);

        return view('admin.UpdateAnimalProfile', compact('animalProfiles'));
    }
}
