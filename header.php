<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TransLogix - Advanced Transportation Logistics</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'ice-blue': '#D6E6F2',
                        'powder-blue': '#A6C6DB',
                        'sapphire': '#0F52BA',
                        'navy': '#000A26',
                        primary: '#0F52BA',
                        secondary: '#A6C6DB',
                        'primary-light': '#D6E6F2',
                        'primary-dark': '#000A26',
                        'secondary-light': '#D6E6F2',
                        'secondary-dark': '#A6C6DB'
                    }
                }
            }
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <link rel="stylesheet" href="/TransLogix/css/main.css">
    <link rel="stylesheet" href="/TransLogix/css/testimonial-slider.css">
    <style>
        /* Base styles with new color scheme */
        body {
            color: #000A26;
            background-color: #D6E6F2;
        }
        .dark body {
            color: #D6E6F2;
            background-color: #000A26;
        }
        
        /* Updated color scheme for components */
        .bg-blue-600 { background-color: #0F52BA; }
        .bg-blue-700 { background-color: #0A3D8C; }
        .bg-blue-800 { background-color: #072E6B; }
        .bg-blue-50 { background-color: #D6E6F2; }
        .bg-blue-100 { background-color: #C1D9EC; }
        .bg-blue-400 { background-color: #A6C6DB; }
        .bg-blue-500 { background-color: #5E8CB7; }
        
        .text-blue-600 { color: #0F52BA; }
        .text-blue-400 { color: #A6C6DB; }
        .text-blue-300 { color: #D6E6F2; }
        .text-blue-100 { color: #D6E6F2; }
        
        .border-blue-600 { border-color: #0F52BA; }
        .hover\:bg-blue-700:hover { background-color: #0A3D8C; }
        .hover\:text-blue-600:hover { color: #0F52BA; }
        .dark\:hover\:text-blue-400:hover { color: #A6C6DB; }
        
        /* Footer color */
        footer { background-color: #000A26; color: #D6E6F2; }
    </style>
</head>
