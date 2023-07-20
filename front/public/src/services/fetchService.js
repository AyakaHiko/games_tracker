export default function (url, options = {}) {
  if (options.headers) {
    if (typeof options.headers.append === "function") {
      options.headers.append(
        "authorization",
        `Bearer ${localStorage.getItem("token")}`
      );
    } else if (typeof options.headers.authorization === "undefined") {
      options.headers.Authorization = `Bearer ${localStorage.getItem("token")}`;
    }
  } else {
    options.headers = new Headers({
      Authorization: `Bearer ${localStorage.getItem("token")}`,
      //'Content-Type': 'application/json',
    });
  }

  return new Promise((resolve, reject) => {

    fetch(url, options)
      .then((res) => {
        if (res.status === 200 || res.status === 201) {
          try {
            return res.json();
          } catch (e) {
            reject({ message: "Error Json in Fetch" });
          }
        }

        if (res.status === 404) {
          reject({ message: "404 - Not Found in BackEnd" });
        }
      })
      .then((data) => {
        resolve(data);
      })
      .catch((error) => {
        reject(error);
      });
  });
}
