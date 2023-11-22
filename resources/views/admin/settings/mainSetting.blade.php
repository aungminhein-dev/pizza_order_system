@extends('admin.layouts.master')
 @section('title','Account Settings')

 @section('content')
 <div class="container-md">
    <section class="services">
        <h4 class="text-primary mb-3">Settings<i class="fa-solid fa-gears"></i></h4>
        <div class="card-container">
            <div class="card border-0 ">
                <div class="icon"><i class="fa-solid fa-user"></i></div>
                <div class="card-content">
                    <h3 class="card-head">Profile</h3>
                    <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur nobis accusantium rerum eos! Accusamus, ab.</p>
                    <div class="button">
                        <a href="{{route('admin#accountDetails')}}" class="btn-main btn-sm text-black">Edit</a>
                    </div>
                </div>
            </div>
            <div class="card border-0 ">
                <div class="icon"><i class="fa-solid fa-key"></i></div>
                <div class="card-content">
                    <h3 class="card-head">Password</h3>
                    <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur nobis accusantium rerum eos! Accusamus, ab.</p>
                    <div class="button">
                        <a href="{{route('admin#changePasswordPage')}}" class="btn-main btn-sm text-black">Change</a>
                    </div>
                </div>
            </div>
            <div class="card border-0 ">
                <div class="icon"><i class="fa-solid fa-users"></i></div>
                <div class="card-content">
                    <h3 class="card-head">Your Team</h3>
                    <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur nobis accusantium rerum eos! Accusamus, ab.</p>
                    <div class="button">
                        <a href="{{route('admin#list')}}" class="btn-main btn-sm text-black">Manage</a>
                    </div>
                </div>
            </div>
            <div class="card border-0">
                <div class="icon"><i class="fa-solid fa-hotel"></i></div>
                <div class="card-content">
                    <h3 class="card-head">Hotels</h3>
                    <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur nobis accusantium rerum eos! Accusamus, ab.</p>
                    <div class="button">
                        <a href="" class="btn-main btn-sm text-black">Read More</a>
                    </div>
                </div>
            </div>
            <div class="card border-0 ">
                <div class="icon"><i class="fa-solid fa-earth-americas"></i></div>
                <div class="card-content">
                    <h3 class="card-head">Places</h3>
                    <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur nobis accusantium rerum eos! Accusamus, ab.</p>
                    <div class="button">
                        <a href="" class="btn-main btn-sm text-black">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
 </div>
 @endsection
