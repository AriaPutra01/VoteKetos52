<?php

 use App\Http\Controllers\AuthController;
// use App\Http\Controllers\Auth\AuthenticatedSessionController;
// use App\Http\Controllers\Auth\NewPasswordController;
// use App\Http\Controllers\Auth\PasswordResetLinkController;
// use App\Http\Controllers\Auth\RegisteredUserController;
// use App\Http\Controllers\QuestionController;
// use App\Http\Controllers\ResultSimulationController;
// use App\Http\Controllers\SimulationTestController;
// use App\Http\Controllers\SubmissionAnswear;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    // Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth:api');
    Route::get('/me', [AuthController::class, 'me'])->middleware('auth:api');
    // Route::post('/refresh', [AuthControllerServices::class, 'refresh'])->middleware('auth:api');
    // Route::post('/teacher-register', [AuthControllerServices::class, 'teacherRegister'])->middleware('auth:api');
    // Route::post('/student-register', [AuthControllerServices::class, 'studentRegister'])->middleware('auth:api');
});

// Route::group([
//     'middleware' => 'api',
//     'prefix' => 'simulation'
// ], function ($router) {
//     Route::post('/create', [SimulationTestController::class, 'createSimulation'])->middleware('auth:api');
//     Route::delete('/delete/{id}', [SimulationTestController::class, 'deleteSimulation'])->middleware('auth:api');
//     Route::put('/update/{id}', [SimulationTestController::class, 'updateSimulation'])->middleware('auth:api');
//     Route::get('/list', [SimulationTestController::class, 'index'])->middleware('auth:api');
//     Route::get('/generate-pin-room/{id}', [SimulationTestController::class, 'getSimulationByIdAndMajorWithPIN'])->middleware('auth:api');
//     Route::post('/sent-pin-room-to-children', [SimulationTestController::class, 'sendPinRoomToChildren'])->middleware('auth:api');
//     Route::post('/join-participant-to-room/{id}', [SimulationTestController::class, 'joinParticipantToRoom'])->middleware('auth:api');
//     Route::post('/sent-participant-to-room/{id}', [SimulationTestController::class, 'confirmParticipant'])->middleware('auth:api');
//     Route::post('/remove-participant/{id}', [SimulationTestController::class, 'removeParticipant'])->middleware('auth:api');
//     Route::post('/sent-question-to-participant/{id}', [SimulationTestController::class, 'sentQuestionToParticipants'])->middleware('auth:api');

//     Route::post('/submission/{room_id}', [SubmissionAnswear::class, 'store'])->middleware('auth:api');

//     Route::get('/result', [ResultSimulationController::class, 'getAllResult'])->middleware('auth:api');
//     Route::post('/check-status-participant', [ResultSimulationController::class, 'checkStatus'])->middleware('auth:api');
// });

// Route::group([
//     'middleware' => 'api',
//     'prefix' => 'question'
// ], function ($router) {
//     Route::delete('/delete-all', [QuestionController::class, 'deleteQuestionAll'])->middleware('auth:api');
//     Route::post('/create', [QuestionController::class, 'createQuestionAct'])->middleware('auth:api');
//     Route::get('/list', [QuestionController::class, 'getQuestion'])->middleware('auth:api');
//     Route::put('/update-all/{id}', [QuestionController::class, 'updateQuestion'])->middleware('auth:api');
//     Route::get('/question-by-simulation-id/{simulationId}', [QuestionController::class, 'getQuestionBySimulationId'])->middleware('auth:api');
// });

// Route::middleware('guest')->group(function () {
//     Route::post('register', [RegisteredUserController::class, 'store']);
//     Route::post('forgot-password', [PasswordResetLinkController::class, 'store']);
//     Route::post('reset-password-token-check', [PasswordResetLinkController::class, 'checkToken'])->name('password.reset');
//     Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store');
// });
