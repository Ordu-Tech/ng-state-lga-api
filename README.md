# Nigeria States and LGAs API

This API allows you to retrieve a list of states in Nigeria in JSON format. And if a state's name is add at the end part the local government areas associated with the state are printed out in json format.

## Endpoints

- **`GET /`** - Retrieve a list of all states in Nigeria
- **`GET /state`** - Retrieve a list of all local government areas in the state

## Usage

You can make a GET request to the API using your preferred HTTP client.

Example using **`curl`**:

`GET list of all states`
```
curl http://state-lga-api.ordutech.com/api/
```

`GET list of all LGAs in states`
```
curl http://state-lga-api.ordutech.com/api/state/
```

Example using **`fetch`** in **`JavaScript`**:

`GET list of all states`
```
fetch('http://state-lga-api.ordutech.com/api/')
  .then(response => response.json())
  .then(data => console.log(data))
  .catch(error => console.error(error))
```

`GET list of all LGAs in states`
```

let state = 'rivers'
fetch('http://state-lga-api.ordutech.com/api/${state}/')
  .then(response => response.json())
  .then(data => console.log(data))
  .catch(error => console.error(error))
```

## Response

The API will return a JSON object containing an array of all the states in Nigeria and in the case where the state is mentioned the LGAs will be returned.

Example response:

`GET list of all states`
```
//Response for state GET /api/
{
    "Abia": " abia",
    "Adamawa": "adamawa",
    ...
}
```

`GET list of all states`
```
//Response for LGAs GET /api/rivers/
{
    "Port Harcourt": "port-harcourt",
    "Obio-Akpor": "obio-akpor",
    ...
}
```

## Note

- Make sure to replace the url with the correct endpoint
- Also, check for any error message or status code returned by the API

## Support

Please contact the developer if you have any questions or issues regarding this API [OrduTech](https://ordutech.com/#contact).
