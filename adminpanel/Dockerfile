FROM node:10 as build

RUN ["mkdir", "/frontend"]

WORKDIR /frontend

COPY package*.json ./

RUN ["npm", "install"]

COPY . .

RUN ["npm", "run", "build"]

FROM webdevops/nginx:alpine

COPY --from=build /frontend/dist /app

ENV WEB_DOCUMENT_INDEX index.html
