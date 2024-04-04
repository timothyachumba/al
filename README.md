# akukolabs.com

The online platform for akukolabs.com built using [Kirby CMS](https://getkirby.com/).

## URLs

- [akukolabs.test](http://akukolabs.test) - your local development site
- [staging.akukolabs.com](https://staging.akukolabs.com) - the staging site
- [akukolabs.com](https://akukolabs.com) - the production site

## Development

We are using **composer** to manage PHP dependencies and **pnpm** to manage frontend dependencies. **Vite** is used to build the frontend assets.

### Getting started

1. Clone this repository's development branch
2. Run `composer install`
3. Run `pnpm install`

### Running the site locally

On OSX use Laravel Herd. On Windows and Linux use whatever works. Avoid using the php built-in server as it does not support Kirby perfectly.

- Set the local domain to `akukolabs.test` to match predefined Kirby configs
- Run `pnpm run dev` to watch for changes in the frontend assets
- Run `pnpm run build` to build the frontend assets

### Staging Server

The staging server reflects the **development** branch. It is automatically deployed to [staging.akukolabs.com](https://staging.akukolabs.com) when the **development** branch is updated.

### Deploying the site

Deployment is done the same way as the staging server. The*production server is automatically deployed to [akukolabs.com](https://akukolabs.com) when the **production** branch is updated.

### Contributing

That is what you need to do to contribute to the project using a pull request workflow:

1. Create a new branch from the **development** branch
2. Make your changes, commit them them and push the branch to the remote repository
3. Create a pull request to the **development** branch
4. Wait for the pull request to be reviewed and merged
5. Repeat

If possible split your commits into multiple commits that each represent a single change. This makes it easier to review your pull request and to revert changes if necessary.

Try to keep your pull requests small and focused on a single feature or bug fix. This way merging is easier and the risk of introducing bugs is lower. Split your work into multiple pull requests if necessary.

### Frontend

- We are using Layouts with Snippets and Slots at the highest hierarchy level possible. Avoid creating new Layouts.
- All frontend assets are automatically loaded based on the templates name. You do NOT need to and in fact should NOT use the `css()` and `js()` helpers. The needed assets are automatically registered based on the template name. Add a lib with `pnpm` and you will be able to use it anywhere in the project.
- All images are lazyloaded through a single snippet. Use that and nothing else. Define the the required pixel-perfect srcsets in the `config/config.php` file once layout has been approved.
- Optimize all static images using tools (or web-services) like `imageoptim` and `svgo` before adding them to the project.

### Content Folder

You will be able to download a current copy of the content folder from a shared Dropbox folder. The `content` folder is not part of the repository and should not be added to the repository. You might need to create the same content locally and on the staging server manually via the panel. Consider it a reasonable invested time to check if the panel is working correctly instead of a chore.

### Performance and Caching

If you notice that a page is slow to load take a note and discuss it with the team unless you know yourself how to implement proper caching to solve the issue.

### Backend Access for Clients via the Panel

The `public/index.php` can switch the loaded blueprint folder based on the role of the user. This allows us to give clients access to the panel without giving them access to the admin version of the panel. Here is how to add code to that setup:

1. create a new folder for the role based on `site/blueprints/` but only keep the blueprints that you need to override, remove the rest
2. if you need to re-use existing blueprints without modification you add them in the **users** plugin. Search for `reload_blueprints` to find the right place. You can also add your required blueprints there across all roles.
3. Add all your custom blueprints to the core blueprints folder. Only use the new folder to overwrite existing behavior like limiting the visible pages in the panel etc.

___
EOF
