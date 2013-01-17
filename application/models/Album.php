<?php

/**
 * Album
 *
 * @package Amuzi
 * @version 1.0
 * Amuzi - Online music
 * Copyright (C) 2010-2013  Diogo Oliveira de Melo
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
class Album extends DZend_Model
{
    public function search($q)
    {
        $list = $this->_lastfmModel->searchAlbum($q);
        $ret = [];

        foreach ($list as $item) {
            $album = $this->_lastfmModel->getAlbum(
                $item['musicTitle'], $item['artist']
            );

            $this->_albumDb->insert(
                array(
                    'name' => $album->musicTitle,
                    'cover' => $album->cover,
                    'artist_id'=> $this->_artistModel->insert($album->artist),
                )
            );



            $ret[] = $album;
        }

        return array();
    }
}