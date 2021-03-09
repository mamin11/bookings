@extends('layouts.dashboard')
@section('content')

<style>
    .success-body {
        text-align: center;
        padding: 40px 0;
    }
        .success-h1 {
        color: #88B04B;
        font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
        font-weight: 900;
        font-size: 40px;
        margin-bottom: 10px;
        }
        .success-p {
        color: #404F5E;
        font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
        font-size:20px;
        margin: 0;
        }
    .success-icon-class {
        color: #9ABC66;
        font-size: 100px;
        line-height: 200px;
        margin-left:-15px;
    }
    .success-card {
        padding: 60px;
        border-radius: 4px;
        display: inline-block;
        margin: 0 auto;
    }
</style>

<div class="container">
    <div class="row mt-4 d-flex justify-content-center">
        <div class="success-body">
        <div class="success-card">
            <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
            <i class="checkmark success-icon-class">✓</i>
            </div>
            <h1 class="success-h1">Success</h1> 
            <p class="success-p">We received your payment<br/> A confirmation email will be sent shortly!</p>
        </div>
        </div>
    </div>
</div>

@endsection