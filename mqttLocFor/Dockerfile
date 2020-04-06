# docker build -t wildai_mqtt-loc-for .
# docker run --rm -ti --name WildAI-mqttLocFor --network footprints -v /mnt/w251/WildAI/mqttLocFor:/app -w /app wildai_mqtt-loc-for

FROM alpine

RUN apk update
RUN apk add mosquitto-clients
RUN apk add py3-paho-mqtt

#RUN mkdir app
#COPY . /app
#WORKDIR /app

#ENTRYPOINT ["python3" ]
#CMD ["run.py" ]
