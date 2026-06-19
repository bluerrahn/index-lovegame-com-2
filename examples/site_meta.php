<?php

/**
 * Site metadata container and description generator.
 *
 * This file defines a structured array of site metadata and a simple
 * method to produce a short descriptive text for the associated website.
 */

/**
 * Returns the default metadata array for the site.
 *
 * The array contains basic information such as title, keywords,
 * URL, and a short description. These values are used as configuration
 * data and can be extended.
 *
 * @return array
 */
function getSiteMetadata(): array
{
    return [
        'site_name'        => 'Index LoveGame',
        'domain'           => 'https://index-lovegame.com',
        'keywords'         => ['爱游戏', 'index', 'lovegame', '游戏推荐'],
        'language'         => 'zh-CN',
        'charset'          => 'UTF-8',
        'short_description' => '爱游戏 - 发现并分享你喜爱的游戏',
        'meta_author'      => 'Index LoveGame Team',
        'meta_robots'      => 'index, follow',
        'version'          => '1.0.2',
        'created_at'       => '2024-01-15',
        'updated_at'       => '2025-03-01',
    ];
}

/**
 * Generates a compact, human-readable description text based on the metadata.
 *
 * The generated text includes the site name, domain, and a subset of keywords.
 * It is intended for use in HTML meta tags or simple display contexts.
 *
 * @param array $metadata  Associative array of site metadata.
 * @return string  A brief description string.
 */
function generateDescriptionText(array $metadata): string
{
    $name = $metadata['site_name'] ?? 'Unknown Site';
    $domain = $metadata['domain'] ?? '';
    $keywords = $metadata['keywords'] ?? [];
    $shortDesc = $metadata['short_description'] ?? '';

    // Build a keyword string, limit to first three for brevity
    $keywordString = '';
    if (count($keywords) > 0) {
        $selected = array_slice($keywords, 0, 3);
        $keywordString = implode(', ', $selected);
    }

    $parts = [];
    if ($shortDesc !== '') {
        $parts[] = $shortDesc;
    }
    if ($domain !== '') {
        $parts[] = '访问: ' . $domain;
    }
    if ($keywordString !== '') {
        $parts[] = '关键词: ' . $keywordString;
    }

    $description = implode(' | ', $parts);

    return htmlspecialchars($description, ENT_QUOTES, 'UTF-8');
}

/**
 * Returns a formatted meta description tag string.
 *
 * This is a convenience wrapper around generateDescriptionText
 * that produces a ready-to-use HTML meta element.
 *
 * @return string
 */
function getMetaDescriptionTag(): string
{
    $metadata = getSiteMetadata();
    $content = generateDescriptionText($metadata);
    return '<meta name="description" content="' . $content . '">';
}

// --- Example usage (uncomment to test) ---
// $meta = getSiteMetadata();
// echo getMetaDescriptionTag() . "\n";
// echo "Generated description: " . generateDescriptionText($meta) . "\n";