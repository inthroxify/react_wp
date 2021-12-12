import "./index.scss";
import {useEffect, useState} from "react";

const Banner = () => {
  const [error, setError] = useState(null);
  const [isLoaded, setIsLoaded] = useState(false);
  const [banner, setBanner] = useState([]);

  useEffect(() => {
    fetch(`/wp-json/wp/v2/homepage_image`)
      .then(response => {
        if (response.ok) {
          return response.json();
        }
        throw response;
      })
      .then(data => {
        setBanner(data);
      })
      .catch(error => {
        setError(error);
      })
      .finally(() => {
        setIsLoaded(true);
      });
  }, []);

  let imgUrl = (error || !isLoaded) ? "/blog/logo512.png" : banner.url;

  return (
    <div className="banner"
         style={{
           backgroundImage: `url(${imgUrl})`
         }}
    >
      &nbsp;
    </div>
  );

}

export default Banner;
