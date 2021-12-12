import "./index.scss";
import NotFound from "../NotFound";
import {Link, useParams} from "react-router-dom";
import {useEffect, useState} from "react";
import ReactHtmlParser from 'react-html-parser';

const Posts = () => {
  let params = useParams();

  const niceImageUrl = (post) => {
    let url = "/blog/logo512.png";
    if ( !!post._embedded["wp:featuredmedia"] ) {
      url = (post._embedded["wp:featuredmedia"][0]).source_url ;
    }
    return url;
  }

  const [error, setError] = useState(null);
  const [isLoaded, setIsLoaded] = useState(false);
  const [posts, setPosts] = useState([]);

  useEffect(() => {
    fetch(`/wp-json/wp/v2/posts?_embed`)
      .then(response => {
        if (response.ok) {
          return response.json();
        }
        throw response;
      })
      .then(data => {
        setPosts(data);
      })
      .catch(error => {
        setError(error);
      })
      .finally(() => {
        setIsLoaded(true);
      });
  }, []);

  if (error) {
    return <div>Error: {error.message}</div>;
  } else if (!isLoaded) {
    return <div>Loading...</div>;
  } else {

    // Render a specific post if it was requested.
    if (!!params.id) {

      // See if we have the requested post, if we don't have it say it is not found, otherwise render it.
      let post = posts.find(obj => obj.id === parseInt(params.id));
      if (!post) {
        return <NotFound/>;
      }

      return (
        <div className="post-page" key={post.id}>
          <div className="thumbnail">
            <img alt={post.slug} src={niceImageUrl(post)}/>
          </div>
          <div className="title">
            <h2>{post.title.rendered}</h2>
          </div>
          <div className="date">
            <p>Date: {(new Date(post.date_gmt)).toLocaleString()}</p>
          </div>
          <div className="content">
            {ReactHtmlParser(post.content.rendered)}
          </div>
        </div>
      );

    } else {

      //Render a list of all posts if a specific post was not requested.
      return (
        <div className="posts">
          <h1>Hey, here are some blog posts!</h1>
          {posts.map(post => (
            <div className="post-item" key={post.id}>
              <Link to={`post/${post.id}`}>
                <div className="thumbnail">
                  <img alt={post.slug} src={niceImageUrl(post)}/>
                </div>
                <h2>{post.title.rendered}</h2>
                <p>Date: {(new Date(post.date_gmt)).toLocaleString()}</p>
              </Link>
            </div>
          ))}
        </div>
      );
    }
  }
}

export default Posts;
