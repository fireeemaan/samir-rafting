@extends('layouts.app')

@section('title', 'Booking')

@section('content')
    <div class="container p-8">
        <div class="justify-center items-center">
            <div class="flex flex-col gap-1 package-details outline outline-black/10 w-64 rounded-md shadow-xs">
                <div class="flex w-full">
                    <img class="size-auto object-fill rounded-t-md" src="{{ asset( 'storage/' . $package->thumbnail ) }}" alt="">
                </div>
                <div class="details flex flex-col px-4 pb-4">
                    <h1 class="text-lg font-bold">{{ $package->name }}</h1>
                    <p class="text-sm text-black/50">{{ $package->description }}</p>
                    <svg class="w-full h-1 my-2 mt-12 opacity-50" xmlns="http://www.w3.org/2000/svg">
                        <line x1="0" y1="0" x2="100%" y2="0" stroke="#9ca3af" stroke-width="2" stroke-dasharray="6,4" />
                    </svg>
                    <div class="flex flex-col w-full rules gap-2">
                        <div class="py-1.5 px-2 text-sm font-semibold bg-gray-50/50 shadow-md rounded-lg border border-black/5">
                            <p>Cannot be rescheduled</p>
                        </div>
                        <div class="py-1.5 px-2 text-sm font-semibold bg-gray-50/50 shadow-md rounded-lg border border-black/5">
                            <p>Cannot be refunded</p>
                        </div>
                    </div>
                </div>

            </div>
            <div>
                <div>

                </div>
            </div>
        </div>
    </div>
@endsection
