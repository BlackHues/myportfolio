<?php

return [

    'project_types' => [
        'basic_brochure' => 'Basic / brochure website',
        'landing' => 'Landing page',
        'ecommerce' => 'E-commerce',
        'charity_ngo' => 'Charity / NGO',
        'dashboard' => 'Dashboard / admin panel',
        'other' => 'Other (describe in message)',
    ],

    'packages' => [
        'starter' => [
            'label' => 'Starter',
            'price' => '₹5,000',
            'bullets' => [
                'Basic website (up to 4 pages)',
                'Mobile-friendly responsive layout',
                'WhatsApp + contact form integration',
                'Best for personal and small business launch',
            ],
        ],
        'growth' => [
            'label' => 'Business',
            'price' => '₹12,000',
            'bullets' => [
                'Business website (up to 8 pages)',
                'SEO-ready structure and on-page setup',
                'Content sections for services and testimonials',
                'Ideal for lead generation websites',
            ],
        ],
        'pro' => [
            'label' => 'Premium',
            'price' => '₹15,000 - ₹20,000',
            'bullets' => [
                'Advanced website or web app scope',
                'Custom modules and admin workflows',
                'Performance, analytics, and scaling support',
                'Final quote based on feature requirements',
            ],
        ],
    ],

];
