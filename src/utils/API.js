import axios from "axios";

export default axios.create({
  baseURL: "https://ec2-18-224-139-141.us-east-2.compute.amazonaws.com/gsp/gsp_api/api/",
  responseType: "json"
});