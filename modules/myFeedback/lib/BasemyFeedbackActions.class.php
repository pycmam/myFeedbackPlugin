<?php

class BasemyFeedbackActions extends sfActions
{
    /**
     * Показать форму вопроса
     */
    public function executeIndex()
    {
        if (! isset($this->defaults)) {
            $this->defaults = array();
        }

        if ($this->getUser()->isAuthenticated() && $user = $this->getUser()->getGuardUser()) {
            $this->defaults = array_merge($this->defaults, array(
                'name'  => $user->getFirstName() .' '. $user->getLastName(),
                'email' => $user->getEmailAddress(),
            ));
        }

        $this->success = false;
        $this->form = new FeedbackForm($this->defaults);
    }

    /**
     * Обработка отправки формы
     */
    public function executeCreate(sfWebRequest $request)
    {
        $this->executeIndex();

        $this->setTemplate('index');

        $this->form->bind($request->getParameter($this->form->getName()));
        if ($this->form->isValid()) {
            $this->getMailer()->createAndSend(
                sfConfig::get('app_mail_admin_email'),
                'LittleSMS.ru: ' . $this->form->getValue('subj'),
                $this->getPartial('myFeedback/mail/message.txt', $this->form->getValues()),
                sfConfig::get('app_mail_from_email'),
                $this->form->getValue('email')
            );

            $this->executeIndex();

            $this->success = true;
        }

        if ($request->isXmlHttpRequest()) {
            return $this->renderPartial('myFeedback/form', array(
                'form' => $this->form,
                'success' => $this->success,
            ));
        }
    }
}