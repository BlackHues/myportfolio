<?php

return [

    'featured' => [
        [
            'accent' => 'emerald',
            'title' => 'Bestway Facade Co. L.L.C',
            'url' => 'https://www.bestwayfc.com/',
            'region_badge' => 'Corporate · UAE',
            'description' => 'Premium aluminium and glazing facade contractor serving the UAE construction market.',
            // Put file in public/images/projects/ then set path below (or use a full https URL)
            'image' => 'images/projects/bestwayfc.png',
            'highlights' => [
                'Showcases curtainwall, glass facades, cladding, doors & windows, and skylights with clear product storytelling.',
                'Structured sections for projects, divisions, careers, and enquiries so visitors can explore and get in touch easily.',
                'Responsive, image-led layout that works smoothly on mobile and desktop.',
            ],
            'cta_label' => 'View project',
            'ui' => [
                // Fallback if live URL palette cannot be fetched (cached 24h from site)
                'primary_hex' => '#047857',
                'secondary_hex' => '#0d9488',
                'font_heading' => 'Outfit / DM Sans',
                'font_body' => 'system-ui, sans-serif',
                'features' => [
                    'Hero + service grids',
                    'Image galleries & project strips',
                    'Enquiry-led CTAs',
                ],
            ],
        ],
        [
            'accent' => 'violet',
            'title' => 'Maha Vidhya Charitable Trust',
            'url' => 'https://mahavidhyacharitabletrust.org.in/',
            'region_badge' => 'NGO · India',
            'description' => 'Non-profit focused on education and community support for underprivileged families.',
            'image' => 'images/projects/maha-vidhya.png',
            'highlights' => [
                'Explains programmes in education, social welfare, and relief with simple navigation for donors.',
                'Clear paths to donate, volunteer, view leadership, gallery, and contact—including WhatsApp-friendly reach.',
                'Warm, accessible visuals and typography that build trust with supporters.',
            ],
            'cta_label' => 'View project',
            'ui' => [
                // Fallback if live URL palette cannot be fetched
                'primary_hex' => '#6d28d9',
                'secondary_hex' => '#c026d3',
                'font_heading' => 'Outfit / Fraunces',
                'font_body' => 'system-ui, sans-serif',
                'features' => [
                    'Soft sections & donation focus',
                    'Readable long-form content',
                    'Social / WhatsApp links',
                ],
            ],
        ],
    ],

];
