<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Get all notifications for the logged-in user, paginated.
     */
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();
        // TODO: load related model e.g. following user
        return $user->notifications()->paginate();
    }
}
