<?php
/*
Gibbon, Flexible & Open School System
Copyright (C) 2010, Ross Parker

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program. If not, see <http://www.gnu.org/licenses/>.
*/

namespace Gibbon\Forms\Builder;

interface FormBuilderInterface
{
    public function getFormID();

    public function getPageID();

    public function getPageNumber();
    
    public function hasField($fieldName) : bool;

    public function getField($fieldName);

    public function hasDetail($name) : bool;

    public function getDetail($name, $default = null);

    public function hasConfig($name) : bool;

    public function getConfig($name, $default = null);
}