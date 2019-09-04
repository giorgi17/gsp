import axios from "axios";

export default axios.create({
  baseURL: "http://localhost/gsp/gsp_api/api/",
  responseType: "json"
});