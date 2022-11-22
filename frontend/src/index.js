import React from 'react';
import ReactDOM from 'react-dom';
import './index.css';
import App from './App';
import reportWebVitals from './reportWebVitals';
import {Provider} from "react-redux";
import {Store} from "./Store/Store";

ReactDOM.render(
  <React.StrictMode>
      <Provider store={Store}>
          <App/>
      </Provider>
  </React.StrictMode>,
  document.getElementById('root')
);

reportWebVitals();
