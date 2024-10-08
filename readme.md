
# Altcha OctoberCMS Plugin

This is the implementation of [Altcha](https://altcha.org/) for OctoberCMS, provided as a plugin that you can use in your project. 

As stated on the main website, Altcha is a free, open source Captcha alternative. ALTCHA uses a proof-of-work mechanism to protect your website, APIs, and online services from spam and unwanted content.

![Altcha In Action](in-action.png)


## Installation

Currently, this plugin is only available via cloning from GitHub.

1. Navigate to your plugins directory:
   ```
   $ cd your_plugins_path
   ```

2. Create a directory named `yfktn`:
   ```
   $ mkdir yfktn
   ```

3. Navigate into the `yfktn` directory:
   ```
   $ cd yfktn
   ```

4. Clone the repository:
   ```
   $ git clone https://github.com/yfktn/altcha-oc altcha
   ```

After cloning, you need to run the `october:migrate` command to apply the migration scripts for this plugin.

```
$ cd your_project_root
$ php artisan october:migrate
```
## How To Use

### Set Env Variables

In your `.env` variable, set the following variables:

```
# required, secret hmac key ...
ALTCHA_HMAC_KEY=
# optional, the maximum random number
ALTCHA_MAX_NUMBER=100000
# optional, challenge expired in seconds
ALTCHA_EXPIRED=30
```

### Challenge URL

You can choose between using the free API at altha.org API or the built-in URL provided by this plugin.

By default, the url is set to: `https://your.domain.com/yourbackend/yfktn/altcha/challenger/getchallenge`

### Add AltchaField Component

In your form, simply add the AltchaField Component. 

![Add altchafileld component](altchafield-insert.png)

### Use the Validator

In your submit action method, you need to execute AltchaField validator to validate the request.

```php
$captchaFieldName = post('captcha-field-name');
$isRecaptchaFails = true;
if($enableCaptcha) {
   // Check for spam?
   $recaptchaValidator = Validator::make(post(), [
         $captchaFieldName => ['required', new \Yfktn\Altcha\Classes\AltchaValidator($captchaFieldName)],
   ]); 
   $isRecaptchaFails = $recaptchaValidator->fails();
}
```

## More Documentation

You can access detailed documentation on how to use it on the main website at [altcha.org](https://altcha.org/).
