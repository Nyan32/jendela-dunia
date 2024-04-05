<?php

namespace App\Validation;

use App\Models\Author;
use App\Models\Genre;
use App\Models\Publisher;

class CustomRule
{
    public function genderValidation(string $str, ?string &$error = null): bool
    {
        if ($str == 'M' || $str == 'F') {
            return true;
        } else {
            return false;
        }
    }

    public function categoryValidation(string $str, ?string &$error = null): bool
    {
        if ($str == 'non-fiction' || $str == 'fiction') {
            return true;
        } else {
            return false;
        }
    }

    public function statusValidation(string $str, ?string &$error = null): bool
    {
        if ($str == 'available' || $str == 'unavailable') {
            return true;
        } else {
            return false;
        }
    }

    public function publisherIDValidation(string $str, ?string &$error = null): bool
    {
        if ($str != '') {
            $model = new Publisher();
            $id = $str;
            $publisherCount = $model->select()->where('id', $id)->findAll();
            if (count($publisherCount) > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }

    public function authorIDValidation(string $str, ?string &$error = null): bool
    {
        if ($str != '') {
            $model = new Author();
            $id = array_unique(explode(':', $str));

            for ($i = 0; $i < count($id); $i++) {
                $authorCount = $model->select()->where('id', $id[$i])->findAll();
                if (count($authorCount) <= 0) {
                    return false;
                }
            }
            return true;
        } else {
            return true;
        }
    }

    public function genreIDValidation(string $str, ?string &$error = null): bool
    {
        if ($str != '') {
            $model = new Genre();
            $id = array_unique(explode(':', $str));

            for ($i = 0; $i < count($id); $i++) {
                $genreCount = $model->select()->where('id', $id[$i])->findAll();
                if (count($genreCount) <= 0) {
                    return false;
                }
            }
            return true;
        } else {
            return false;
        }
    }
}
