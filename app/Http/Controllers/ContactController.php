<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;
use App\Models\MenuImage;
use Illuminate\Support\Facades\Validator;
use App\Mail\ReservationConfirmation;
use App\Mail\ContactConfirmation;
use Illuminate\Support\Facades\Mail;
use Cloudinary\Cloudinary;
use Cloudinary\Api\ApiUtils;
class ContactController extends Controller
{
    public function send(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'type' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $contact = ContactMessage::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'type' => 'contact',
        ]);
        $email = "jbull635@gmail.com";
        // Envoi de l'email de confirmation
        Mail::to($email)->send(new ContactConfirmation($request->name, $request->email, $request->subject, $request->message));

        return response()->json(['message' => 'Message envoyé avec succès.'], 201);
    }

    public function sendPrivatisation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $contact = ContactMessage::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'type' => 'privatisation',
        ]);

        // Envoi de l'email de confirmation

        $email = "jbull635@gmail.com";
        Mail::to($email)->send(new ReservationConfirmation($request->name, $request->email, $request->subject, $request->message));

        return response()->json(['message' => 'Demande de privatisation envoyée avec succès.'], 201);
    }

    public function getAllMessages()
    {
        $messages = ContactMessage::orderBy('created_at', 'desc')->paginate(10);
        
        return response()->json([
            'success' => true,
            'data' => $messages->items(),
            'pagination' => [
                'current_page' => $messages->currentPage(),
                'last_page' => $messages->lastPage(),
                'per_page' => $messages->perPage(),
                'total' => $messages->total(),
                'from' => $messages->firstItem(),
                'to' => $messages->lastItem(),
                'has_more_pages' => $messages->hasMorePages(),
                'next_page_url' => $messages->nextPageUrl(),
                'prev_page_url' => $messages->previousPageUrl()
            ]
        ], 200);
    }

    public function getContactInfo(Request $request)
    {
        $query = ContactMessage::select('id', 'name', 'email', 'subject', 'type', 'created_at');
        
        // Filtrer par type si spécifié
        if ($request->has('type') && $request->type) {
            $query->where('type', $request->type);
        }
        
        $contacts = $query->orderBy('created_at', 'desc')->paginate(10);
        
        return response()->json([
            'success' => true,
            'data' => $contacts->items(),
            'pagination' => [
                'current_page' => $contacts->currentPage(),
                'last_page' => $contacts->lastPage(),
                'per_page' => $contacts->perPage(),
                'total' => $contacts->total(),
                'from' => $contacts->firstItem(),
                'to' => $contacts->lastItem(),
                'has_more_pages' => $contacts->hasMorePages(),
                'next_page_url' => $contacts->nextPageUrl(),
                'prev_page_url' => $contacts->previousPageUrl()
            ]
        ], 200);
    }

    public function addMenuImage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image_of_menu' => 'required|string|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $menuImage = MenuImage::create([
            'image_of_menu' => $request->image_of_menu,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Image de menu ajoutée avec succès.',
            'data' => $menuImage
        ], 201);
    }

    public function getAllMenuImages()
    {
        $menuImages = MenuImage::orderBy('created_at', 'asc')->get();
        
        return response()->json([
            'success' => true,
            'data' => $menuImages
        ], 200);
    }

    public function deleteMenuImage($id)
    {
        $menuImage = MenuImage::find($id);
        
        if (!$menuImage) {
            return response()->json([
                'success' => false,
                'message' => 'Image de menu non trouvée.'
            ], 404);
        }

        $menuImage->delete();

        return response()->json([
            'success' => true,
            'message' => 'Image de menu supprimée avec succès.'
        ], 200);
    }

    public function generateSignature(Request $request)
    {
        $timestamp = time();

        // Manually generate the signature using Cloudinary's helper method
        $params_to_sign = [
            'timestamp' => $timestamp,
        ];

        // Generating the signature
        $signature = ApiUtils::signParameters($params_to_sign, "BzO-9abAfyiiib7aLj7KfiS4EVI");

        return response()->json([
            'signature' => $signature,
            'timestamp' => $timestamp,
            'api_key' => 743419794116277,
            'cloud_name' => "dcjfeebzi"
        ]);
    }

    
}
