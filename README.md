
# PACKAGES

Laravel Passport

# FIRST DEPLOY

https://laravel.com/docs/9.x/passport#deploying-passport

Create path secrets/oauth to input keys

```mkdir secrets```\
```mkdir secrets/oauth```

After, run command below:

```php artisan migrate```

```php artisan passport:keys```

```php artisan passport:client --personal```


# DOCUMENTAÇÃ́O

## Blueprint

[Porque?](https://dev.delivery/documentacao-api-rest/) <br>
[Blueprint](https://apiblueprint.org/)

## Aglio

Install

```npm install aglio```

Doc

[Doc Aglio](https://github.com/danielgtaylor/aglio#readme)

```aglio -i api.apib --them-full-width --no-thme-condense -o ../public/docs/index.html```

# Tests

    $ touch database/test.sqlite
    $ php artisan migrate --seed --env=testing

**Run**

    ./vendor/bin/phpunit


# ROUTES

Base ```https://api.clubecasadesign.com.br/v1/```

**Authentication**
    
    POST /login
            - email
            - password
            
dfg

    GET /stores?with=region,address,segments (partial)
    GET /store/{id}/?with=region,address,segments (partial)
    GET /store/{id}?with=region,address,segments (partial)

    GET /profile (OK)
    (in new update) GET /profile?with=conctats,location,landing-page (NO)
    POST /profile/edit/ (NO)
    POST /profile/edit/conctats (NO)
    POST /profile/edit/location (NO)
    POST /profile/edit/password-reset (NO)
    POST /profile/edit/update-profile-image (NO)
    POST /profile/edit/landing-page (NO)


# Annotations

    @route("/blog", name="blog_list")
    @param string $input
    @return string
    @package App\Annotation
    @throws \Exception
    @var ArrayCollection $metadata
    @required
    @length(50)
    

