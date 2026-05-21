<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TicketCommentController;
use App\Models\Category;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {

    if (Auth::user()->role === 'admin') {

        $totalCategories = Category::count();
        $activeCategories = Category::where('active', true)->count();
        $totalTickets = Ticket::count();
        $openTickets = Ticket::where('status', 'Aberto')->count();
        $progressTickets = Ticket::where('status', 'Em andamento')->count();
        $resolvedTickets = Ticket::where('status', 'Resolvido')->count();

        return view('dashboard', compact(
            'totalCategories',
            'activeCategories',
            'totalTickets',
            'openTickets',
            'progressTickets',
            'resolvedTickets'
        ));
    }

    $myTickets = Ticket::where('user_id', Auth::id())->get();

    $myOpenTickets = $myTickets->where('status', 'Aberto')->count();
    $myProgressTickets = $myTickets->where('status', 'Em andamento')->count();
    $myResolvedTickets = $myTickets->where('status', 'Resolvido')->count();

    return view('dashboard-user', compact(
        'myTickets',
        'myOpenTickets',
        'myProgressTickets',
        'myResolvedTickets'
    ));

})->middleware(['auth'])->name('dashboard');


Route::middleware(['auth'])->group(function () {

    Route::resource('categories', CategoryController::class);

    Route::resource('tickets', TicketController::class);

    Route::get('/tickets/{ticket}/attend', [TicketController::class, 'attend'])
        ->name('tickets.attend');

    Route::patch('/tickets/{ticket}/attend', [TicketController::class, 'updateAttendance'])
        ->name('tickets.updateAttendance');

    Route::post('/tickets/{ticket}/comments', [TicketCommentController::class, 'store'])
        ->name('tickets.comments.store');

    Route::get('/tickets/{ticket}/comments/live', [TicketController::class, 'liveComments'])
        ->name('tickets.comments.live');

});


Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});

require __DIR__.'/auth.php';