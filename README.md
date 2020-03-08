## Environment setup

### Needed tools

1. [Install Docker](https://www.docker.com/get-started)
2. Clone this project: `git clone https://github.com/adnumaro/o2o.git`
3. Move to the project folder: `cd o2o`

### Environment configuration

Create a local environment file if needed: `cp .env .env.dist`

### Application execution

1. Install PHP dependencies and bring up the project Docker containers with Docker Compose: `make build` or bring up with Symfony: `make start-local`
2. Go to [the API health check page](http://api.o2o.localhost:8030/integration/health-check)
3. To bring down the project, just execute `make stop` with Docker Compose or `make stop-local` with Symfony

## Project explanation

I used DDD with Hexagonal Architecture and a very simple repository pattern. The main idea is to separate all
the integrations from company base applications, and if it is needed, the rest of applications can access to integrations
by HTTP Client.

### Bounded Contexts

* [Integration](src/Integration): This must contains all external integrations.
    - [PunkApi](src/Integration/src/PunkApi): Integration example with external API

### Structure

```
$ tree -L 6 src

src
├── Integration
│   ├── bin
│   │   └── console
│   ├── config
│   │   ├── bundles.php
│   │   ├── packages
│   │   │   ├── cache.yaml
│   │   │   ├── framework.yaml
│   │   │   ├── prod
│   │   │   │   └── routing.yaml
│   │   │   ├── routing.yaml
│   │   │   └── test
│   │   │       └── framework.yaml
│   │   ├── routes
│   │   │   └── dev
│   │   │       └── framework.yaml
│   │   ├── routes.yaml
│   │   └── services.yaml
│   ├── public
│   │   └── index.php
│   └── src
│       ├── Kernel.php
│       ├── PunkApi
│       │   ├── Application
│       │   │   ├── BeerDetails.php
│       │   │   └── SearchBeerByFood.php
│       │   ├── Domain
│       │   │   ├── Beer.php
│       │   │   ├── BeerCollection.php
│       │   │   ├── IRepository.php
│       │   │   └── ValueObject
│       │   │       ├── Description.php
│       │   │       ├── FirstBrewed.php
│       │   │       ├── Id.php
│       │   │       ├── ImageUrl.php
│       │   │       ├── Name.php
│       │   │       ├── QueryCriteria.php
│       │   │       └── Slogan.php
│       │   └── Infrastructure
│       │       ├── Controller
│       │       │   ├── BeerDetailsController.php
│       │       │   ├── HealthCheckController.php
│       │       │   └── SearchBeerByFoodController.php
│       │       ├── Repository.php
│       │       ├── Service
│       │       │   └── Client.php
│       │       └── Transformer
│       │           └── BeerCollectionTransformer.php
│       └── Shared
│           ├── Domain
│           │   ├── Collection.php
│           │   └── ValueObject
│           │       ├── ArrayValueObject.php
│           │       ├── IntValueObject.php
│           │       └── StringValueObject.php
│           └── Infrastructure
│               └── Service
│                   └── ApiClient.php      
└── bootstrap.php
```
