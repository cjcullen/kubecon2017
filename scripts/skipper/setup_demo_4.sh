#!/bin/bash

export KUBECONFIG=$(mktemp /tmp/kubeconfig.XXXXXX)

# Point at demo-3 cluster
gcloud container clusters get-credentials demo-3 --zone=us-west1-b --project=gcastle-gke-dev

# Create Kubernetes objects
kubectl delete -n payments -f ../../pyramidschemecorp/manifests/3_payments.yaml
kubectl create -n payments -f ../../pyramidschemecorp/manifests/4_payments.yaml
kubectl delete -n signup -f ../../pyramidschemecorp/manifests/3_signup.yaml
kubectl create -n signup -f ../../pyramidschemecorp/manifests/4_signup.yaml
echo "KUBECONFIG=${KUBECONFIG}"
