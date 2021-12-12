import './App.scss';
import { Route, Routes } from "react-router-dom";
import Posts from "./components/Posts";
import NotFound from "./components/NotFound";
import Banner from "./components/Banner";

const App = () => {
  return (
      <div className="App">
        <Banner/>
        <Routes>
          <Route exact path="/" element={<Posts />} />
          <Route path="/post/:id" element={<Posts />} />
          <Route path="*" element={<NotFound />}/>
        </Routes>
      </div>
  );
}

export default App;
