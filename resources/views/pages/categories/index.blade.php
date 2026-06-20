@php $active = 'categories'; @endphp
@extends('layouts.app')

@section('title', 'التصنيفات | اسأل قلقيلية')

@section('content')

{{-- Hero --}}
<section class="border-b border-slate-200 bg-white">
    <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-extrabold text-slate-950 sm:text-4xl">تصنيفات الأعمال</h1>
        <p class="mt-3 max-w-2xl text-base leading-7 text-slate-600">تصفح جميع تصنيفات الأعمال في قلقيلية واكتشف الخدمات القريبة منك.</p>
    </div>
</section>

{{-- Categories Grid --}}
<section class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
    @forelse ($categories as $category)
        @if ($loop->first)
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        @endif

        <a href="{{ route('categories.show', $category->slug) }}"
           class="group flex flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:border-blue-200 hover:shadow-md focus:outline-none focus:ring-4 focus:ring-blue-100">
            @if ($category->image)
            <div class="h-32 overflow-hidden bg-slate-100">
                <img src="{{ asset('images/categories/' . $category->image) }}"
                     alt="{{ $category->name }}"
                     class="h-full w-full object-cover transition group-hover:scale-105" />
            </div>
            @else
            <div class="flex h-32 items-center justify-center bg-blue-50 text-4xl">
                {{ $category->icon ?? '🏪' }}
            </div>
            @endif
            <div class="flex flex-1 flex-col p-5">
                <h2 class="text-lg font-extrabold text-slate-950">{{ $category->name }}</h2>
                @if ($category->description)
                <p class="mt-1 text-sm leading-6 text-slate-600 line-clamp-2">{{ $category->description }}</p>
                @endif
                <p class="mt-3 text-sm font-extrabold text-[#2563EB]">{{ $category->businesses_count }} نشاط تجاري</p>
            </div>
        </a>

        @if ($loop->last)
        </div>
        @endif

    @empty
    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        @foreach ([
            ['name' => 'مطاعم وكافيهات', 'icon' => '🍽️', 'count' => 48, 'img' => 'restaurants-cafes.jpg'],
            ['name' => 'صيدليات وصحة', 'icon' => '💊', 'count' => 24, 'img' => 'clinics.jpg'],
            ['name' => 'تعليم وتدريب', 'icon' => '📚', 'count' => 31, 'img' => 'education.jpg'],
            ['name' => 'محلات تجارية', 'icon' => '🛒', 'count' => 67, 'img' => 'retail.jpg'],
            ['name' => 'خدمات تقنية', 'icon' => '🔧', 'count' => 19, 'img' => 'technicians.jpg'],
            ['name' => 'عيادات أطباء', 'icon' => '🏥', 'count' => 22, 'img' => 'clinics.jpg'],
        ] as $item)
        <div class="flex flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="flex h-32 items-center justify-center bg-blue-50 text-4xl">{{ $item['icon'] }}</div>
            <div class="flex flex-1 flex-col p-5">
                <h2 class="text-lg font-extrabold text-slate-950">{{ $item['name'] }}</h2>
                <p class="mt-3 text-sm font-extrabold text-[#2563EB]">{{ $item['count'] }} نشاط تجاري</p>
            </div>
        </div>
        @endforeach
    </div>
    @endforelse
</section>

@endsection
