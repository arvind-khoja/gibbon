<?php
/*
Gibbon: the flexible, open school platform
Founded by Ross Parker at ICHK Secondary. Built by Ross Parker, Sandra Kuipers and the Gibbon community (https://gibbonedu.org/about/)
Copyright © 2010, Gibbon Foundation
Gibbon™, Gibbon Education Ltd. (Hong Kong)

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
use Gibbon\Data\Validator;

require_once '../../gibbon.php';

$_POST = $container->get(Validator::class)->sanitize($_POST);

$URL = $session->get('absoluteURL').'/index.php?q=/modules/'.getModuleName($_POST['address']).'/userSettings.php';

if (isActionAccessible($guid, $connection2, '/modules/User Admin/userSettings.php') == false) {
    $URL .= '&return=error0';
    header("Location: {$URL}");
} else {
    //Proceed!
    $ethnicity = $_POST['ethnicity'] ?? '';
    $religions = $_POST['religions'] ?? '';
    $nationality = $_POST['nationality'] ?? '';
    $departureReasons = $_POST['departureReasons'] ?? '';
    $privacy = $_POST['privacy'] ?? '';
    $privacyBlurb = $_POST['privacyBlurb'] ?? null;
    $privacyOptions = $_POST['privacyOptions'] ?? null;
    $uniqueEmailAddress = $_POST['uniqueEmailAddress'] ?? 'N';
    $personalBackground = $_POST['personalBackground'] ?? '';

    //Write to database
    $fail = false;

    try {
        $data = array('value' => $ethnicity);
        $sql = "UPDATE gibbonSetting SET value=:value WHERE scope='User Admin' AND name='ethnicity'";
        $result = $connection2->prepare($sql);
        $result->execute($data);
    } catch (PDOException $e) {
        $fail = true;
    }

    try {
        $data = array('value' => $religions);
        $sql = "UPDATE gibbonSetting SET value=:value WHERE scope='User Admin' AND name='religions'";
        $result = $connection2->prepare($sql);
        $result->execute($data);
    } catch (PDOException $e) {
        $fail = true;
    }

    try {
        $data = array('value' => $nationality);
        $sql = "UPDATE gibbonSetting SET value=:value WHERE scope='User Admin' AND name='nationality'";
        $result = $connection2->prepare($sql);
        $result->execute($data);
    } catch (PDOException $e) {
        $fail = true;
    }

    try {
        $data = array('value' => $departureReasons);
        $sql = "UPDATE gibbonSetting SET value=:value WHERE scope='User Admin' AND name='departureReasons'";
        $result = $connection2->prepare($sql);
        $result->execute($data);
    } catch (PDOException $e) {
        $fail = true;
    }

    try {
        $data = array('value' => $privacy);
        $sql = "UPDATE gibbonSetting SET value=:value WHERE scope='User Admin' AND name='privacy'";
        $result = $connection2->prepare($sql);
        $result->execute($data);
    } catch (PDOException $e) {
        $fail = true;
    }

    try {
        $data = array('value' => $privacyBlurb);
        $sql = "UPDATE gibbonSetting SET value=:value WHERE scope='User Admin' AND name='privacyBlurb'";
        $result = $connection2->prepare($sql);
        $result->execute($data);
    } catch (PDOException $e) {
        $fail = true;
    }

    try {
        $data = array('value' => $privacyOptions);
        $sql = "UPDATE gibbonSetting SET value=:value WHERE scope='User Admin' AND name='privacyOptions'";
        $result = $connection2->prepare($sql);
        $result->execute($data);
    } catch (PDOException $e) {
        $fail = true;
    }

    try {
        $data = array('value' => $uniqueEmailAddress);
        $sql = "UPDATE gibbonSetting SET value=:value WHERE scope='User Admin' AND name='uniqueEmailAddress'";
        $result = $connection2->prepare($sql);
        $result->execute($data);
    } catch (PDOException $e) {
        $fail = true;
    }

    try {
        $data = array('value' => $personalBackground);
        $sql = "UPDATE gibbonSetting SET value=:value WHERE scope='User Admin' AND name='personalBackground'";
        $result = $connection2->prepare($sql);
        $result->execute($data);
    } catch (PDOException $e) {
        $fail = true;
    }

    if ($fail == true) {
        $URL .= '&return=error2';
        header("Location: {$URL}");
    } else {
        //Success 0
        getSystemSettings($guid, $connection2);
        $URL .= '&return=success0';
        header("Location: {$URL}");
    }
}
