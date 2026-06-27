<?php

use App\Modules\ForgeComponents\Definitions\ButtonDefinition;
use App\Modules\ForgeComponents\Definitions\InputDefinition;
use App\Modules\ForgeComponents\Enums\ButtonVariant;
use App\Modules\ForgeComponents\Enums\InputType;

?>

<div class="fc-auth-card">
  <div class="fc-auth-card__header">
    <h1 class="fc-auth-card__heading">Create an account</h1>
    <p class="fc-auth-card__subtitle">Get started with Forge today</p>
  </div>

  <div class="fc-auth-card__body">
    <?= component('ForgeComponents:alert') ?>

    <?= form_open(action: '/auth/register', attrs: ['class' => 'fc-stack fc-stack--md']) ?>
      <?= component(name: 'ForgeComponents:input', props: new InputDefinition(
          type: InputType::TEXT,
          name: 'identifier',
          id: 'identifier',
          label: 'Identifier',
          placeholder: 'Choose a username',
          required: true,
      )) ?>

      <?= component(name: 'ForgeComponents:input', props: new InputDefinition(
          type: InputType::EMAIL,
          name: 'email',
          id: 'email',
          label: 'Email',
          placeholder: 'Enter your email',
          required: true,
      )) ?>

      <?= component(name: 'ForgeComponents:input', props: new InputDefinition(
          type: InputType::PASSWORD,
          name: 'password',
          id: 'password',
          label: 'Password',
          placeholder: 'Create a password',
          required: true,
      )) ?>

      <?= component(name: 'ForgeComponents:input', props: new InputDefinition(
          type: InputType::PASSWORD,
          name: 'confirm_password',
          id: 'confirm_password',
          label: 'Confirm Password',
          placeholder: 'Confirm your password',
          required: true,
      )) ?>

      <?= component(name: 'ForgeComponents:button', props: new ButtonDefinition(
          variant: ButtonVariant::PRIMARY,
          block: true,
      ), slots: ['children' => 'Create account']) ?>
    <?= form_close() ?>
  </div>

  <div class="fc-auth-card__footer">
    <p>Already have an account? <a href="/auth/login">Sign in</a></p>
  </div>
</div>
