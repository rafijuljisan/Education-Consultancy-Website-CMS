<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id
 * @property string $site_name
 * @property string|null $site_logo
 * @property string|null $site_favicon
 * @property string $primary_color
 * @property string $secondary_color
 * @property string $hero_title
 * @property string|null $hero_description
 * @property string|null $hero_image
 * @property string $hero_button_text
 * @property string $hero_button_url
 * @property string|null $meta_description
 * @property string|null $contact_email
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GeneralSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GeneralSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GeneralSetting query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GeneralSetting whereContactEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GeneralSetting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GeneralSetting whereHeroButtonText($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GeneralSetting whereHeroButtonUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GeneralSetting whereHeroDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GeneralSetting whereHeroImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GeneralSetting whereHeroTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GeneralSetting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GeneralSetting whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GeneralSetting wherePrimaryColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GeneralSetting whereSecondaryColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GeneralSetting whereSiteFavicon($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GeneralSetting whereSiteLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GeneralSetting whereSiteName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GeneralSetting whereUpdatedAt($value)
 */
	class GeneralSetting extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

