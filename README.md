# Radar Domain Session Demo

This is a demo showing how to use
[Cadre.DomainSession](https://github.com/cadrephp/Cadre.DomainSession) with
[Radar](https://github.com/radarphp/Radar.Project).

## Setup

```bash
git clone https://github.com/futureproofphp/radar-domain-session.git
cd radar-domain-session

# Install dependencies
composer install
```

## Example

This demo is very simple and mirrors the functionality of the non-radar demo included in [Cadre.DomainSession](https://github.com/cadrephp/Cadre.DomainSession/blob/0.x/public/index.php).

To simplify getting and setting cookies in PSR-7 I'm using the excellent [dflydev-fig-cookies](https://github.com/dflydev/dflydev-fig-cookies) library.

In the `Input` we fetch the session id cookie value. It is null if none exists.

It loads the session (creates a new one if none exists) and checks to see if there is a timestamp value present.  If none it returns "Unknown" and assigns the current timestamp to the session.

The session is finished and persisted.

In the `Responder` we check to see if there was a session returned from the domain.
If so, we assign the session id to the session cookie with an updated expires time and possibly a new value.
