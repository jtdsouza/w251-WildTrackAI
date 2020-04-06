# docker build -t mqttBrok .
# docker run --name mqttBrok --network footprints -p 1883:1883 alpine

FROM alpine

RUN apk update
RUN apk add mosquitto

CMD /usr/sbin/mosquitto
