# Demo React Blog App Backed By WordPress

## Getting Started
### Prerequisites:
* Docker
  * One that is new enough to have the "compose" command included.

### On your command line:
```bash
git clone https://github.com/inthroxify/react_wp.git
cd react_wp
docker compose up -d
```

### In your browser:
For the React app: 
* [http://localhost:84/blog/](http://localhost:84/blog/)

For the WordPress/admin: 
* [http://localhost:84/wp-admin/](http://localhost:84/wp-admin/)
* **Username:** user
* **Password:** bitnami 

## Features
* React routing V6. _Not your grandma's router._
* Blog banner image settable via WordPress admin interface.
  * To set the banner of the blog via the WordPress admin interface, simply set the featured image of the Homepage. For your convenience, the Homepage is currently set to the "Home Page" page.
* A tiny plugin was written to extend the WordPress REST API, adding an endpoint to quickly retrieve the blog banner image.
* For development, node is reverse-proxied, so urls are nicer to deal with.
  * If a production build in `frontend/build` is present, it will serve that first. Delete/rename `frontend/build/index.html` to fall through to the development node server.

## Things to Know
* In developing this I tried to keep in mind Agile Manifesto Principal 10 -- maximize work _not_ done -- so, work that was not asked for isn't included if it wasn't described, unless it was reasonable to do in a short time. As such:
  * Existing WordPress GUIs were used creatively to offer configuration functionality.
  * A tiny, simple, and quick WordPress plugin was written to extend the WordPress REST API.
  * A boilerplate template was used for the outer page design.
* The Docker containers are just ones from Bitnami, they made it easy to get started with development.
* The original WordPress site is still viewable at [/](http://localhost:84/)
* If a Post in WordPress does not have a featured image set, a default image will be used.

### About the Banner Image of the React Blog App
* It is the _Featured Image_ of the WordPress "Homepage". I don't mean simply the "Home" page, I mean the page that is specified in the WordPress theme customizer:
  * (wp-admin > Appearance > Customize > Homepage Settings > Homepage pulldown). 
  * "Home Page" is the currently set Homepage.
  * This saves hard-coding a post or page in the React app code to get the banner image.
* To set a different banner image than the current one:
  * [Edit the "Home Page" page](http://localhost:84/wp-admin/post.php?post=11&action=edit) in the WordPress Admin interface.
  * In the page editor, find "featured image" in the right-hand menu, and press the button there. It brings up the media picker interface.
  * Select a different image with the WordPress media picker, and press the Set button. 
  * Save the changes to the page by pressing the Update button of the page editor.

### Creating New Blog App Posts
* Simply create a new post in the WordPress admin interface, and be sure to set a Featured Image on it.
