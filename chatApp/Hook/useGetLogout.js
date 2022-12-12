export default function useGetJWT() {

    return function (username, password) {
        const credentials = btoa(`${username}:${password}`);

        return fetch(`http://localhost:8245/logout`,
            {method: 'POST'}).then(data => data.json())
    }
}