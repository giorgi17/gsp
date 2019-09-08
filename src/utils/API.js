import axios from "axios";

export default axios.create({
  // baseURL: "https://master.d1ubo1y2yglotf.amplifyapp.com/gsp/gsp_api/api/",
  baseURL: "/gsp/gsp_api/api/",
  responseType: "json"
});