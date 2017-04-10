<?php

namespace app\helpers;

use app\models\I18n;
use app\models\Language;
use Doctrine\ORM\EntityRepository;

class SlugHelper {

    /**
     * @param I18n $i18n
     * @param string $srcValue
     * @param EntityRepository $repository
     * @return string
     */
    public function generateUniqueSlugForI18n(I18n $i18n, $srcValue, EntityRepository $repository) {
        $language = $i18n->getLanguage();
        if(empty($srcValue)) {
            $srcValue = "a-" . $language->getId();
        }

        $tHepler = new TransliterationHelper();
        $srcValueTranslit = $tHepler->transliterateString($srcValue);
        $i = 1;
        do {
            $slug = $srcValueTranslit;
            if($i > 1) {
                $slug .= '-' . $i;
            }
            $i++;
        } while(!$this->slugIsUnique($slug, $language, $repository));

        return $slug;
    }

    private function slugIsUnique($slug, Language $language, EntityRepository $repository) {
        $entity = $repository->findBy([
            'languageId' => $language->getId(),
            'slug' => $slug,
        ]);
        return empty($entity);
    }

}