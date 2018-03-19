<?php
declare(strict_types = 1);
namespace TYPO3\CMS\Core\Site\Entity;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

/**
 * Entity representing a sys_sitelanguage configuration of a site object.
 */
class SiteLanguage
{
    /**
     * @var Site
     */
    protected $site;

    /**
     * The language mapped to the sys_language DB entry.
     *
     * @var int
     */
    protected $languageId;

    /**
     * Locale, like 'de_CH' or 'en_GB'
     *
     * @var string
     */
    protected $locale;

    /**
     * The Base URL for this language
     *
     * @var string
     */
    protected $base;

    /**
     * Label to be used within TYPO3 to identify the language
     * @var string
     */
    protected $title = 'Default';

    /**
     * Label to be used within language menus
     * @var string
     */
    protected $navigationTitle = '';

    /**
     * The flag key (like "gb" or "fr") used to be used in TYPO3's Backend.
     * @var string
     */
    protected $flagIdentifier = 'us';

    /**
     * The iso code for this language (two letter) ISO-639-1
     * @var string
     */
    protected $twoLetterIsoCode = 'en';

    /**
     * Language tag for this language defined by RFC 1766 / 3066 for "lang"
     * and "hreflang" attributes
     *
     * @var string
     */
    protected $hreflang = 'en-US';

    /**
     * The direction for this language
     * @var string
     */
    protected $direction = '';

    /**
     * Prefix for TYPO3's language files
     * "default" for english, otherwise one of TYPO3's internal language keys.
     * Previously configured via TypoScript config.language = fr
     *
     * @var string
     */
    protected $typo3Language = 'default';

    /**
     * @var string
     */
    protected $fallbackType = 'strict';

    /**
     * @var array
     */
    protected $fallbackLanguageIds = [];

    /**
     * Additional parameters configured for this site language
     * @var array
     */
    protected $attributes = [];

    /**
     * SiteLanguage constructor.
     * @param Site $site
     * @param int $languageId
     * @param string $locale
     * @param string $base
     * @param array $attributes
     */
    public function __construct(Site $site, int $languageId, string $locale, string $base, array $attributes)
    {
        $this->site = $site;
        $this->languageId = $languageId;
        $this->locale = $locale;
        $this->base = $base;
        $this->attributes = $attributes;
        if (!empty($attributes['title'])) {
            $this->title = $attributes['title'];
        }
        if (!empty($attributes['navigationTitle'])) {
            $this->navigationTitle = $attributes['navigationTitle'];
        }
        if (!empty($attributes['flag'])) {
            $this->flagIdentifier = $attributes['flag'];
        }
        if (!empty($attributes['typo3Language'])) {
            $this->typo3Language = $attributes['typo3Language'];
        }
        if (!empty($attributes['iso-639-1'])) {
            $this->twoLetterIsoCode = $attributes['iso-639-1'];
        }
        if (!empty($attributes['hreflang'])) {
            $this->hreflang = $attributes['hreflang'];
        }
        if (!empty($attributes['direction'])) {
            $this->direction = $attributes['direction'];
        }
        if (!empty($attributes['fallbackType'])) {
            $this->fallbackType = $attributes['fallbackType'];
        }
        if (!empty($attributes['fallbacks'])) {
            $this->fallbackLanguageIds = $attributes['fallbacks'];
        }
    }

    /**
     * Returns the SiteLanguage in an array representation for e.g. the usage
     * in TypoScript.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'languageId' => $this->getLanguageId(),
            'locale' => $this->getLocale(),
            'base' => $this->getBase(),
            'title' => $this->getTitle(),
            'navigationTitle' => $this->getNavigationTitle(),
            'twoLetterIsoCode' => $this->getTwoLetterIsoCode(),
            'hreflang' => $this->getHreflang(),
            'direction' => $this->getDirection(),
            'typo3Language' => $this->getTypo3Language(),
            'flagIdentifier' => $this->getFlagIdentifier(),
            'fallbackType' => $this->getFallbackType(),
            'fallbackLanguageIds' => $this->getFallbackLanguageIds(),
        ];
    }

    /**
     * @return Site
     */
    public function getSite(): Site
    {
        return $this->site;
    }

    /**
     * @return int
     */
    public function getLanguageId(): int
    {
        return $this->languageId;
    }

    /**
     * @return string
     */
    public function getLocale(): string
    {
        return $this->locale;
    }

    /**
     * @return string
     */
    public function getBase(): string
    {
        return $this->base;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getNavigationTitle(): string
    {
        return $this->navigationTitle ?? $this->getTitle();
    }

    /**
     * @return string
     */
    public function getFlagIdentifier(): string
    {
        return $this->flagIdentifier;
    }

    /**
     * @return string
     */
    public function getTypo3Language(): string
    {
        return $this->typo3Language;
    }

    /**
     * @return string
     */
    public function getFallbackType(): string
    {
        return $this->fallbackType;
    }

    /**
     * Returns the ISO-639-1 language ISO code
     *
     * @return string
     */
    public function getTwoLetterIsoCode(): string
    {
        return $this->twoLetterIsoCode ?? '';
    }

    /**
     * Returns the RFC 1766 / 3066 language tag
     *
     * @return string
     */
    public function getHreflang(): string
    {
        return $this->hreflang ?? '';
    }

    /**
     * Returns the language direction
     *
     * @return string
     */
    public function getDirection(): string
    {
        return $this->direction ?? '';
    }

    /**
     * @return array
     */
    public function getFallbackLanguageIds(): array
    {
        return $this->fallbackLanguageIds;
    }
}