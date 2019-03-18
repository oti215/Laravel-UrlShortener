# Laravel-UrlShortener

This is a Url Shortening API.

<strong>How does this API shorten urls?</strong>
Using the open-source <a href="https://hashids.org/php/">Hashids</a> PHP library, which implements a robust algorithm to obfuscate numbers. I used Hashid to create a unique hash of desired length (6 characters), based on the primary key field of the stored Url, which guarantees we will have a unique hash per each new url. Incoming requests for short urls will simply lookup the hash value. 

<strong>Application Setup 1 (php artisan serve):</strong><br>
<ol>
    <li>In your terminal, navigate to an empty folder</li>
    <li>Clone into the repository by running this command: <strong>git clone</strong> https://github.com/oti215/Laravel-UrlShortener.git</li>
    <li>Navigate into the cloned repository</li>
    <li>Create and migrate the database, see Database Setup section below</li>
    <li>Run the following command: php artisan serve</li>
    <li>The app will now be running at http://127.0.0.1:8000</li>
</ol>

<strong>Database Setup:</strong>
<ol>
    <li>You may set up the application's database in the server of your choosing. I used <a href="https://www.mamp.info/en/">MAMP</a>, which comes prepackaged with MySQL, and hosted my website on a virtual host in Apache.</li>
    <li>
        Be sure to include your database connection information in the .env file.
        <ul>
            <li>DB_CONNECTION=mysql</li>
            <li>DB_HOST=127.0.0.1</li>
            <li>DB_PORT=3306</li>
            <li>DB_DATABASE=homestead</li>
            <li>DB_USERNAME=root</li>
            <li>DB_PASSWORD=root</li>
        </ul>
    </li>
    <li>Remember to create the database with the same name as specified in the .env file</li>
    <li>Once you have your credentials and database connection info set up, and your database is created in your database server, just run: <strong>php artisan migrate</strong></li>
</ol>

<h2>The API has the following endpoints which may be used without authentication:</h2>
<ol>
    <li>
        Create Short Url
        <ul>
            <li>Type: POST</li>
            <li>Path: /api/url/create_short_url </li>
            <li>Form Body: { url: 'valid url string' } </li>
            <li>Description: This endpoint will create a 6 character hash (using <a href="https://hashids.org/php/">Hashids PHP library</a>) to represent the passed url, it will then append this hash to the API's URL, thus forming a unique short url. You can change the APP_URL variable in the .env.</li>
        </ul>
    </li>
    <li>
        Get Top Visited Urls
        <ul>
            <li>Type: GET</li>
            <li>Path: /api/url/get_most_visited/{rows?} </li>
            <li><strong>Optional</strong> Query Param: # of rows desired. If omitted, will default to 100 as per requirement.</li>
        </ul>
    </li> 
    <li>
        Visit Short Url (redirect to long url)
        <ul>
            <li>Type: GET</li>
            <li>Path: /{hash} </li>
            <li>Description: This will redirect the user to the stored url for the given hash and increment the amount of visits for this specific short url</li>
        </ul>
    </li>
</ol>

<h3>Response Body</h3>
Create short url response
```
{
    "_META": {
        "status": "ok",
        "messages": [
            {
                "message": "Short url created succesfully for: https://github.com/oti215/Laravel-UrlShortener",
                "type": "ok"
            }
        ]
    },
    "_DATA": {
        "shortUrl": "http://localhost:8000/P3aJ8q"
    }
}
```
Error handling
```
{
    "_META": {
        "status": "error",
        "messages": [
            {
                "message": "We only shorten urls less than or equal to 191 characters!",
                "type": "error"
            }
        ]
    },
    "_DATA": []
}
```
<h4>API Constraints:</h4>
<ul>
    <li>Maximum url length is 191 characters</li>
    <li>Url <strong>must</strong> have protocol info to be considered valid, for example: https, http.</li>
</ul>
