# Nusa Penida Tattoo WordPress Theme

![Version](https://img.shields.io/badge/version-1.0.0-blue.svg)
![WordPress](https://img.shields.io/badge/WordPress-5.0+-blue.svg)
![PHP](https://img.shields.io/badge/PHP-7.4+-purple.svg)

Premium WordPress theme for Nusa Penida Tattoo studio featuring glassmorphism design, modern UI, and responsive layout.

## Features

- 🎨 **Glassmorphism Design** - Modern, sleek glass-effect UI
- 📱 **Fully Responsive** - Works perfectly on all devices
- ⚡ **Performance Optimized** - Fast loading with lazy loading images
- 🌐 **SEO Ready** - Optimized for search engines
- ♿ **Accessibility** - WCAG compliant
- 🎭 **Smooth Animations** - CSS animations and transitions
- 📧 **WhatsApp Integration** - Direct booking via WhatsApp
- 🖼️ **Portfolio Section** - Showcase tattoo designs
- ❓ **FAQ Accordion** - Interactive FAQ section
- 🗺️ **Location Section** - Google Maps ready

## Theme Structure

```
nusatatto/
├── dist/
│   ├── css/
│   │   ├── main.css         # Main Tailwind CSS
│   │   └── customs.css      # Custom styles & animations
│   └── js/
│       └── main.js          # JavaScript functionality
├── inc/
│   ├── enqueue.php          # CSS & JS enqueue
│   ├── setup.php            # Theme setup
│   └── ...
├── template-parts/
│   ├── header.php           # Navigation header
│   └── footer.php           # Footer section
├── front-page.php           # Homepage template
├── index.php                # Main template
├── functions.php            # Theme functions
├── style.css                # Theme stylesheet (required)
└── README.md                # This file
```

## Installation

1. Download the theme files
2. Upload to `/wp-content/themes/nusatatto/`
3. Activate the theme in WordPress Admin
4. Customize via Appearance > Customize

## Requirements

- WordPress 5.0 or higher
- PHP 7.4 or higher
- Modern browser with CSS3 support

## Configuration

### Images Setup

Add these images to `/assets/images/` folder:

- `hero-bg.jpg` - Hero background image
- `about-studio.jpg` - About section image
- `portfolio-1.jpg` to `portfolio-6.jpg` - Portfolio images
- `location-map.jpg` - Location map image

### WhatsApp Number

Edit the WhatsApp number in:
- `template-parts/header.php` (line 38)
- `template-parts/footer.php` (line 66)
- `front-page.php` (multiple locations)

Default: `6281337567256`

### Customization

Main color variables in `/dist/css/customs.css`:

```css
:root {
    --primary: #0f0f0f;      /* Dark background */
    --secondary: #1a1a1a;    /* Secondary dark */
    --accent: #d4af37;       /* Gold accent */
    --light: #f5f5f5;        /* Light text */
}
```

## Sections Included

1. **Hero** - Full-screen hero with headline and CTA buttons
2. **About** - Studio introduction with statistics
3. **Portfolio** - 6-item grid with hover overlays
4. **Why Us** - 6 feature cards with icons
5. **FAQ** - Accordion-style questions
6. **Location** - Contact info and map
7. **CTA** - Final call-to-action section

## JavaScript Features

- Mobile menu toggle
- Smooth scroll navigation
- FAQ accordion
- Portfolio hover effects
- Lazy loading images
- Scroll animations
- Navbar background on scroll

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile browsers (iOS Safari, Chrome Mobile)

## Credits

- **Design & Development**: Nusa Penida Tattoo Studio
- **Tailwind CSS**: https://tailwindcss.com
- **Font**: Segoe UI (system font)

## License

This theme is licensed under the GNU General Public License v2 or later.

## Support

For support, email: info@nusapeni​datatattoo.com

## Changelog

### Version 1.0.0 - 2025-01-19
- Initial release
- Glassmorphism design
- Full responsive layout
- Portfolio section
- FAQ accordion
- WhatsApp integration
- SEO optimized

---

**Nusa Penida Tattoo** - Ink Your Island Story ✨
