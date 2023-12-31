<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('update Behaviour Settings');
$I->loginAsAdmin();
$I->amOnModulePage('School Admin', 'behaviourSettings.php');

// Grab Original Settings --------------------------------------

$originalFormValues = $I->grabAllFormValues();
$I->seeInFormFields('#content form', $originalFormValues);

// Make Changes ------------------------------------------------

$newFormValues = array(
    'enableDescriptors'             => 'Y',
    'positiveDescriptors'           => 'Positive1,Positive2,Positive3',
    'negativeDescriptors'           => 'Negative1,Negative2,Negative3',
    'enableLevels'                  => 'Y',
    'levels'                        => 'Level1,Level2,Level3',
    'enableNegativeBehaviourLetters'        => 'Y',
    'behaviourLettersNegativeLetter1Count'  => '4',
    'behaviourLettersNegativeLetter2Count'  => '8',
    'behaviourLettersNegativeLetter3Count'  => '12',
    'policyLink'                    => 'http://test.test',
);

$I->submitForm('#content form', $newFormValues, 'Submit');

// Verify Results ----------------------------------------------

$I->see('Your request was completed successfully.', '.success');
$I->seeInFormFields('#content form', $newFormValues);

// Reset ----------------------------------------------

$resetFormValues = $originalFormValues;
$resetFormValues['enableDescriptors'] = 'Y';
$resetFormValues['enableLevels'] = 'Y';
$resetFormValues['enableNegativeBehaviourLetters'] = 'Y';
$I->submitForm('#content form', $resetFormValues, 'Submit');

// Restore Original Settings -----------------------------------

$I->submitForm('#content form', $originalFormValues, 'Submit');
$I->see('Your request was completed successfully.', '.success');
$I->seeInFormFields('#content form', $originalFormValues);
