<?php

/**
 * Feedback form
 */
class FeedbackForm extends BaseForm
{
    public function configure()
    {
        $this->widgetSchema['name'] = new sfWidgetFormInput();
        $this->widgetSchema['email'] = new sfWidgetFormInput();
        $this->widgetSchema['subj'] = new sfWidgetFormInput();
        $this->widgetSchema['question'] = new sfWidgetFormTextarea();

        $this->validatorSchema['name'] = new sfValidatorString();
        $this->validatorSchema['subj'] = new sfValidatorString();
        $this->validatorSchema['email'] = new sfValidatorEmail();
        $this->validatorSchema['question'] = new sfValidatorString(array(
            'min_length' => 5,
            'max_length' => 1024,
        ));

        $this->widgetSchema->setNameFormat('feedback[%s]');
        $this->disableLocalCSRFProtection();
    }
}
