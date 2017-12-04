#!/bin/bash

export KUBECONFIG=$(mktemp /tmp/kubeconfig.XXXXXX)
SCRIPT_DIR=$(cd $(dirname "${BASH_SOURCE}")/ && pwd)

# Create demo-1 cluster, w/ ABAC enabled
gcloud container clusters create demo-1 --zone=us-west1-b --project=gcastle-gke-dev --enable-legacy-authorization
gcloud container clusters get-credentials demo-1 --zone=us-west1-b --project=gcastle-gke-dev
# Create Kubernetes objects
kubectl create -f ${SCRIPT_DIR}/../../pyramidschemecorp/manifests/1_default.yaml
echo "KUBECONFIG=${KUBECONFIG}"
