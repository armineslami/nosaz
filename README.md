<p align="center"><a href=""><img src="https://raw.githubusercontent.com/armineslami/nosaz/master/public/img/icon-256x256.png" width="256" alt="Logo"></a></p>

<h2 align="center">
Nosaz
<br/>
<br/>
<p>
<a href=""><img src="https://img.shields.io/badge/v1.0.0-blue?label=release" alt="Latest Version"></a>
<a href=""><img src="https://img.shields.io/badge/MIT-%2397ca00?label=licence" alt="License"></a>
</p>
</h2>

## About

Nosaz is an experimental application designed for constructors and engineers to assist with project calculations. I built this in my free time, so it may contain bugs or incomplete features. Please note: **Nosaz** is not intended for production use.

<div align="center">
    <table style="border: none" align="center">
        <tr>
            <td style="padding:10px" align="center">
                <img src="./media/screenshot1.png" alt="Wheel Preview 1" style="max-height: 250px; aspect-ratio: 1 / 1; object-fit: contain;" />
            </td>
            <td style="padding:10px" align="center">
                <img src="./media/screenshot2.png" alt="Wheel Preview 2" style="max-height: 250px; aspect-ratio: 1 / 1; object-fit: contain;" />
            </td>
        </tr>
    </table>
</div>

## Install

1.  Rename `.env.example` to `.env`.
2.  Inside `.env` set app url and database configs.
3.  Set up required configs for Mailtrap (or any other mail service), Google OAuth, Twitter OAuth, Telegram OAuth, and hCaptcha.
4.  Replace Firebase messaging configs with yours in `public/firebase-messaging-sw.js` and `resources/js/firebase.js`. (This step is optional, as the feature is still a work in progress.).
5.  Run `compose install` and `npm install`
6.  Run `php artisan key:generate` & `php artisan migrate`.

## License

The panel is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
