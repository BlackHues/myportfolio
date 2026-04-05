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
            'price' => '₹10,000',
            'bullets' => [
                'Up to 5 pages',
                '1 year domain + hosting included',
                'Working contact form',
                'Mobile-friendly layout',
            ],
        ],
        'growth' => [
            'label' => 'Growth',
            'price' => '₹18,000',
            'bullets' => [
                'Up to 10 pages',
                'SEO-ready structure & meta',
                'WhatsApp / email CTAs',
                '1 year domain + hosting',
            ],
        ],
        'pro' => [
            'label' => 'Pro / Custom',
            'price' => '₹28,000+',
            'bullets' => [
                'E-commerce, dashboard, or auth flows',
                'Admin panel & role basics (scope-based)',
                'Integrations as per requirement',
                'Timeline & price after quick call',
            ],
        ],
    ],

];
