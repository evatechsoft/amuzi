<?php

/**
 * TutorialController
 *
 * @package Amuzi
 * @version 1.0
 * Amuzi - Online music
 * Copyright (C) 2010-2012  Diogo Oliveira de Melo
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
class TutorialController extends DZend_Controller_Action
{
    public function getlistAction()
    {
        $list = $this->_tutorialModel->fetchAll();
        $accomplishedList = $this->_tutorialAccomplishedModel->fetchAllByUser();
        $ret = array();
        foreach ($list as $item) {
            $accomplished = false;
            foreach ($accomplishedList as $itemAccomplished) {
                if ($item->id === $itemAccomplished->tutorialId) {
                    $accomplished = true;
                    break;
                }
            }

            if (!$accomplished) {
                $ret[] = $item->name;
            }
        }

        $this->view->output = $ret;
    }

    public function setaccomplishedAction()
    {
        if (($name = $this->_request->getParam('name')) !== null) {
            $this->_tutorialAccomplishedModel->setAccomplished($name);
        }
    }

    public function welcomeAction()
    {
    }
}