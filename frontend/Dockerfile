FROM node:12.14.0 as build

RUN ["mkdir", "/frontend"]
WORKDIR /frontend
COPY package*.json ./
RUN ["npm", "install"]
COPY . .
ARG firebase_api_key
ENV NUXT_ENV_FIREBASE_API_KEY=$firebase_api_key
RUN ["npm", "run", "build"]

FROM node:12.14.0
RUN ["mkdir", "/app"]
WORKDIR /app
COPY --from=build /frontend/package*.json /app/
RUN ["npm", "install", "--prod"]
COPY --from=build /frontend/.nuxt /app/.nuxt
COPY --from=build /frontend/nuxt.config.js /app/
EXPOSE 3000
CMD ["npm", "run", "start"]
