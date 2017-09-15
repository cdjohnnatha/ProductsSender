<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <h2>{{__('email_verification.title')}}</h2>

    <div>
      {{__('email_verification.body')}}
      {{ URL::to('register/verify/' . $confirmation_code) }}.<br/>

    </div>

  </body>
</html>