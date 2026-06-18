<?php 

namespace App\Enums;

enum SectionComponent: string
{
    case HERO_NEWS = 'hero-news';
    case SPOTI_KENYA = 'spoti-kenya';
    case BUSINESS_NEWS = 'business-news';
    case FEATURED_ARTICLES = 'featured-articles';
    case VIDEO_GALLERY = 'video-gallery';

    public function label(): string
    {
        return match($this) {
            self::HERO_NEWS => 'Hero News',
            self::SPOTI_KENYA => 'Spoti Kenya',
            self::BUSINESS_NEWS => 'Business News',
            self::FEATURED_ARTICLES => 'Featured Articles',
            self::VIDEO_GALLERY => 'Video Gallery',
        };
    }
}