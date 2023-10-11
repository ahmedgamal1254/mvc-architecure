<?php 
require_once 'app/Core/Route.php';

$routes->get("/",[HomeController::class,'index']);
$routes->get("/about",[AboutController::class,'index']);
$routes->get("/services",[ServiceController::class,'index']);
$routes->get("/service/{id}/teacher/{teacher_id}",[ServiceController::class,'show']);
$routes->get("/service/{id}/ahmed/{teacher_id}",[PostController::class,'show']);
$routes->get("/contact_us",[ContactController::class,'index']);
$routes->post("/send_form",[ContactController::class,'store']);

$routes->get("/teacher/{teacher_id}/month/{id}/post/{post_id}",[MonthController::class,'index']);