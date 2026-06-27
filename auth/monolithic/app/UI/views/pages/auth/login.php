<?php

use App\Modules\ForgeComponents\Definitions\ButtonDefinition;
use App\Modules\ForgeComponents\Definitions\InputDefinition;
use App\Modules\ForgeComponents\Enums\ButtonVariant;
use App\Modules\ForgeComponents\Enums\InputType;

?>

<div class="fc-auth-card">
  <div class="fc-auth-card__header">
    <h1 class="fc-auth-card__heading">Welcome back</h1>
    <p class="fc-auth-card__subtitle">Sign in to your account to continue</p>
  </div>

  <div class="fc-auth-card__body">
    <?= component('ForgeComponents:alert') ?>

    <?= form_open(action: '/auth/login', attrs: ['class' => 'fc-stack fc-stack--md']) ?>
      <?= component(name: 'ForgeComponents:input', props: new InputDefinition(
          type: InputType::TEXT,
          name: 'identifier',
          id: 'identifier',
          label: 'Identifier',
          placeholder: 'Enter your username',
          required: true,
      )) ?>

      <?= component(name: 'ForgeComponents:input', props: new InputDefinition(
          type: InputType::PASSWORD,
          name: 'password',
          id: 'password',
          label: 'Password',
          placeholder: 'Enter your password',
          required: true,
      )) ?>

      <?= component(name: 'ForgeComponents:button', props: new ButtonDefinition(
          variant: ButtonVariant::PRIMARY,
          block: true,
      ), slots: ['children' => 'Sign in']) ?>
    <?= form_close() ?>
  </div>

  <div class="fc-auth-card__footer">
    <p>Don't have an account? <a href="/auth/register">Sign up</a></p>
  </div>
</div>
